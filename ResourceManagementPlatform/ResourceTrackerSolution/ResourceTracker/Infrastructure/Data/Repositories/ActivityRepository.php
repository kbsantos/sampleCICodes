<?php
namespace ResourceTrackerSolution\ResourceTracker\Infrastructure\Data\Repositories;


use ResourceTrackerSolution\ResourceTracker\Model\Activities\Activity;
use ResourceTrackerSolution\ResourceTracker\Model\Activities\ActivityId;
use ResourceTrackerSolution\ResourceTracker\Model\Activities\IActivityRepository;
use ResourceTrackerSolution\ResourceTracker\Model\Activities\User;
use ResourceTrackerSolution\ResourceTracker\Model\ActivityDto;
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter\DbContext;
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter\ResourceManagementContext;
use ResourceTrackerSolution\SharedDatabaseManagementTools\Model\ActivityType;
use ResourceTrackerSolution\SharedDatabaseManagementTools\Model\ActualEvents;
use ResourceTrackerSolution\SharedDatabaseManagementTools\Model\UserInActualEvent;
use ResourceTrackerSolution\SharedKernel\IEntity;
use ValueObjects\Person\Name;
use ValueObjects\StringLiteral\StringLiteral;

class ActivityRepository implements IActivityRepository
{
    private $context;

    public function __construct(ResourceManagementContext $context)
    {
        $this->context = $context;
    }

    public function add(IEntity $entity)
    {
        
        $this->context->activities()->add($entity);
        
        if(!empty($entity->event_id))
        {
            $transactions = $this->context
                ->db
                ->get_where('transactions', array('event_id',$entity->event_id ))
                ->result();

            if(!empty($transactions)){

                foreach($transactions as $transaction)
                {
                    $actualEvent = new ActualEvents();
                    $actualEvent->source_id = $entity->getId();
                    $actualEvent->transaction_id = $transaction->id;
                    $this->context->actualEvents()->add($actualEvent);

                    $userInActualEvent = new UserInActualEvent();
                    $userInActualEvent->user_id = $entity->technician_id;
                    $userInActualEvent->actual_event_id = $actualEvent->getId();
                   
                    $this->context->db->insert('user_in_actual_event',$userInActualEvent);
                   // print_r($this->context->db->last_query()); exit();

                }

            }
        }
    }

    public function find(ActivityId $activityId)
    {
        return $this->context->activities()->find((string)$activityId);
    }

    public function fetch()
    {
        return $this->context->activities()->fetch();
    }

    public function update(Activity $activity)
    {
        $this->context->activities()->update($activity);
    }

    public function remove(ActivityId $activityId)
    {
        $this->context->activities()->remove($activityId);
    }

    public function findUser($id, $role)
    {
        return $this->context
            ->db
            ->select('*')
            ->from('Users u')
            ->join('roles r', 'u.role_id = r.id')
            ->where('u.id',$id)
            ->where('u.status','Active')
            ->where('LOWER(r.title)',strtolower($role))
            ->get()
            ->row(0,(string) $this->context->users());
    }

    public function findType($title)
    {
        return $this->context
            ->db
            ->select('*')
            ->from('Activity_Type')
            ->where('title',$title)
            ->where('type','Activity')
            ->get()
            ->row(0,(string) $this->context->activityType());
    }

    public function searchType($title)
    {
        return $this->context
            ->db
            ->select('*')
            ->from('Activity_Type')
            ->like('title',$title, 'right')
            ->where('type','Activity')
            ->get()
            ->result((string) $this->context->activityType());
    }

    //@todo refactor. something crazy here.
    public function getDetails($id)
    {
        $activity = $this->findWithComments($id);
        if(empty($activity)) return;

        if(!empty($activity->event_id))
        {
            $transactions = $this->context
                ->db
                ->select("uae.actual_event_id, uae.user_id, uae.status, uae.notes, t.id, t.name, t.description, t.form_id ,u.email, uae.start_date, uae.end_date,
                        CONCAT_WS(' ',fname, mname,lname) as user_fullname, f.name form_name, NULL as 'fields' ")
                ->from('transactions t')
                ->join('actual_events ae ', 't.id = ae.transaction_id')
                ->join('user_in_actual_event uae', 'ae.id = uae.actual_event_id')
                ->join('Users u', 'uae.user_id = u.id')
                ->join('form f', 'f.id = t.form_id', 'left')
                ->where('ae.source_id', $activity->id)
                ->order_by('t.id', 'asc')
                ->get()
                ->result();

            if(!empty($transactions))
            {
                foreach($transactions as $transaction)
                {
                    if(!empty($transaction->form_id))
                    {
                        $fields = $this->context
                            ->db
                            ->select("ff.id form_field_id, ff.label, ff.name, ff.element,
                                (SELECT faev.value from form_actual_event_values faev
                                where faev.form_field_id = ff.id
                                and faev.actual_event_id = ".$transaction->actual_event_id.") as user_value")
                            ->from('form_fields ff')
                            ->where('ff.form_id', $transaction->form_id)->get()->result();
                        if(!empty($fields)) $transaction->fields = $fields;
                    }
                    $activity->transactions[] = $transaction;
                }
            }

//            $activity->transactions
        }

        return $activity;
    }

    public function fetchByResourceId($resource_id)
    {
        return $this->findActivityDto()
            ->where('technician_id', $resource_id)
            ->or_where('manager_id', $resource_id)
            ->get()
            ->result((string) new ActivityDto());
    }

    public function findWithComments($id)
    {
        $activity = $this->findActivityDto()
            ->where('id', $id)
            ->get()
            ->row(0,(string) new ActivityDto());

        if(empty($activity)) return;
        $this->getComments($activity);
        return $activity;
    }

    public function getComments(ActivityDto $activityDto)
    {
        $comments = $this->context
            ->db
            ->select("ac.id ,ac.comments as comment,
            ac.commented_by as resource_id,
            CONCAT_WS(' ',fname, mname,lname) as fullname, ac.commented_date")
            ->from('Activity_Comments ac')
            ->join('Users u', 'ac.commented_by = u.id')
            ->where('ac.activity_id', $activityDto->id)
            ->order_by('ac.id', 'desc')
            ->get()
            ->result();

        if(!empty($comments))
        {
            $activityDto->comments = $comments;
        }
    }

    private function findActivityDto()
    {
        return $this->context
            ->db
            ->select('*')->from('view_activity_grid');
//        return $this->context
//            ->db
//            ->select("a.id,a.description,
//            a.type_id,
//            a.technician_id,
//            a.manager_id,
//            a.event_id,
//            e.name as event_name,
//            a.longitude,
//            a.latitude,
//            CONCAT_WS(' ',u.fname, u.mname, u.lname) as technician_name,
//            CONCAT_WS(' ',m.fname, m.mname, m.lname) as manager_name")
//            ->from('Activities a')
//            ->join('Users u', 'u.id = a.technician_id','left')
//            ->join('Users m', 'u.id = a.manager_id','left')
//            ->join('events e', 'e.id = a.event_id', 'left')
//            ->order_by('a.id', 'desc');
    }
    
    public function getFeed($resource_id)
    {

        $activities = $this->findActivityDto()
            ->where('technician_id', $resource_id)
            ->or_where('manager_id', $resource_id)
            ->get()
            ->result((string) new ActivityDto());

        if(empty($activities)) return;

        $feed = array();
        foreach($activities as $activity)
        {
            $this->getComments($activity);
            $feed[] = $activity;
        }

        return $feed;
    }
    
    
    public function fetchForServerSideGrid($aGridData,$aColumns,$sTable)
    {
        // Paging
        if(isset($aGridData['iDisplayStart']) && $aGridData['iDisplayLength'] != '-1'){
           $this->context->db->limit($this->context->db->escape_str($aGridData['iDisplayLength']), 
                                     $this->context->db->escape_str($aGridData['iDisplayStart']));
        }
        
        // Ordering
        if(isset($aGridData['iSortCol_0']))
        {
            for($i=0; $i<intval($aGridData['iSortingCols']); $i++)
            {
                $iSortCol   = $aGridData['iSortCol_'.$i];
                $bSortable  = $aGridData['bSortable_'.$i];
                $sSortDir   = $aGridData['sSortDir_'.$i];
    
                if($bSortable == 'true')
                {
                    $this->context->db->order_by($aColumns[intval($this->context->db->escape_str($iSortCol))], $this->context->db->escape_str($sSortDir));
                }
            }
        }
        
        // Filtering
        // NOTE this does not match the built-in DataTables filtering which does it
        // word by word on any field. It's possible to do here, but concerned about efficiency
        // on very large tables, and MySQL's regex functionality is very limited
        if(isset($aGridData['sSearch']) && !empty($aGridData['sSearch'])){
            for($i=0; $i<count($aColumns); $i++){
                $bSearchable =  $aGridData['bSearchable_'.$i];
                
                // Individual column filtering
                if(isset($bSearchable) && $bSearchable == 'true'){
                    $this->context->db->or_like($aColumns[$i], $this->context->db->escape_like_str($aGridData['sSearch']));
                }
            }
        }
        
        // Select Data
        $this->context->db->select(str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        $rResult = $this->context->db->get($sTable);
        
        
        // Data set length after filtering
        $this->context->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->context->db->get()->row()->found_rows;
        
        
        // Total data set length
        $iTotal = $this->context->db->count_all($sTable);
        //return $this->context->db->get()->result((string) $this->context->customers());
        
        // Output
        $output = array(
            'sEcho' => intval($aGridData['sEcho']),
            'iTotalRecords' => intval($iTotal),
            'iTotalDisplayRecords' => intval($iFilteredTotal),
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow){
            $row = array();
            foreach($aColumns as $col){
                $row[] = $aRow[$col];
            }
            $output['aaData'][] = $row;
        }
        
        return $output;
    }
}