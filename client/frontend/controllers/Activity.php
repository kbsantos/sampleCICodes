<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use ResourceTrackerSolution\ResourceTracker\Application\Activities;
use ResourceTrackerSolution\SharedDatabaseManagementTools\Model;
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;
use ResourceTrackerSolution\ResourceTracker\Infrastructure\Data\Repositories\ActivityRepository;
use ResourceTrackerSolution\ResourceTracker\Model\Activities\ActivityId;

class Activity extends MY_Controller {

    private $activityRepository;
    private $context;

    public function __construct()
    {
        parent::__construct();
        $this->context = new CodeIgniter\ResourceManagementContext();
        $this->activityRepository = new ActivityRepository($this->context);

    }

	public function log()
	{
//        $app = new Activities\Activity($this->activityRepository, $this->current_user);
//        $activity = $app->log('description', 1,1,1,1,'In Progress',123546,123546);
//        echo sprintf('New activity added %s with status %s', $activity->getId(), $activity->getStatus());
	}
	
    public function index()
    {
        $aPassData['pageTitle'] = "Activities";
        $aPassData['technicians'] = $this->context
            ->db
            ->select("id,  CONCAT_WS(' ',fname, mname,lname) fullname")
            ->from('Users')->where('role_id',2)
            ->get()
            ->result();
        $aPassData['managers'] = $this->context
            ->db
            ->select("id,  CONCAT_WS(' ',fname, mname,lname) fullname")
            ->from('Users')->where('role_id',1)
            ->get()
            ->result();
        $aPassData['events'] = $this->context->events()->fetch();
        $aPassData['customers'] = $this->context
            ->db
            ->select("id,  CONCAT_WS(' ',fname, mname,lname) fullname")
            ->from('Customers')->where('status !=','BLOCKED')
            ->get()
            ->result();
        //$resource_id = $this->current_user->getId();
        //$activities = $this->activityRepository->fetchByResourceId($resource_id);
        //$this->load->view('pages/resource-tracker/resource_tracker_notifications',$aPassData); 
        $this->load->view('pages/workflow/activity_list',$aPassData);
    }
	
	// public function feed()
 //    {
 //        $aPassData = array();
 //        $aPassData['pageTitle'] = "Feed";
 //        // $feed = $this->activityRepository->getFeed();
 //        $aPassData['feeds'] = $this->activityRepository->getFeed($this->user->getId());
 //        // var_dump($this->activityRepository);
 //        $this->load->view('pages/activity/feed', $aPassData);  
 //    }

    public function details($id)
    {
        //echo '<pre>';
        //var_dump(
          //  $this->activityRepository->getDetails($id)
        //);
        
        $oActivityDetails = $this->activityRepository->getDetails($id);
        
        
       //var_dump($oActivityDetails);
        
        $aPassData['pageTitle'] = "Activity Details";
        $aPassData['ActivityName'] = $oActivityDetails->description;
        $aPassData['Template'] = $oActivityDetails->event_name;
        $aPassData['Client'] = $oActivityDetails->customer_name;
        $aPassData['AssignedDate'] = $oActivityDetails->assigne_date;
        $aPassData['Progress'] = str_replace(' ', '', $oActivityDetails->progress);
        $aPassData['ProgressInt'] = intval(str_replace('%', '', $aPassData['Progress']));
        if($aPassData['ProgressInt'] >= 0 && $aPassData['ProgressInt'] <= 25){
            $aPassData['ProgressColor'] = 'danger';
        }elseif($aPassData['ProgressInt'] >= 25 && $aPassData['ProgressInt'] <= 50){
            $aPassData['ProgressColor'] = 'warning';
        }elseif($aPassData['ProgressInt'] >= 50 && $aPassData['ProgressInt'] <= 100){
            $aPassData['ProgressColor'] = 'success';
        }else{
            $aPassData['ProgressColor'] = 'default';
        }
        
        $aPassData['Transactions'] = $oActivityDetails->transactions;
        $aPassData['Comments'] = $oActivityDetails->comments;
        $this->load->view('pages/workflow/activity_details',$aPassData);
        
    }

    public function updateTransaction()
    {
        $status = $this->input->post('status');
        $userInActualEvent = new Model\UserInActualEvent();
        $userInActualEvent->actual_event_id = $this->input->post('actual_event_id');
        $userInActualEvent->status = empty($status) ? null : $status;
        $userInActualEvent->end_date = empty($status) ? null : date('Y-m-d h:m:s');
        $userInActualEvent->user_id = $this->input->post('user_id');
        $userInActualEvent->notes = $this->input->post('notes');
        $this->context->db
            ->where('actual_event_id', $userInActualEvent->actual_event_id)
            ->where('user_id', $userInActualEvent->user_id)
            ->update((string) $userInActualEvent, $userInActualEvent);

        $this->context->db->where('actual_event_id', $userInActualEvent->actual_event_id);
        $this->context->db->delete('form_actual_event_values');

        $form = $this->input->post('custom_form');
        $this->context->db->insert_batch('form_actual_event_values', $form);
    }

    public function create()
    {

//        $type = $this->activityRepository->findType($this->post('type'));
//        if(empty($type))
//        {
//            echo json_encode(ResponseDto::failed('Invalid type'));
//        }
        $activity = new Model\Activities();
        $activity->title = $this->input->post('title');
        $activity->description = $this->input->post('title');
        $activity->manager_id = $this->input->post('manager_id');
        $activity->technician_id = $this->input->post('technician_id');
        $activity->customer_id = $this->input->post('customer_id');

        $activity->longitude = 0;
        $activity->latitude = 0;
        $activity->event_id = $this->input->post('event_id');
        $activity->type_id = 1;
        $activity->modified_date = date('Y-m-d h:m:s');
        $activity->is_approved = 'Y';
        
        
    
        // $activity = new Model\Activities();
        // $activity->description = 'Open first season for Farmer 1';
        // $activity->manager_id = 1;
        // $activity->technician_id = 5;
        // $activity->customer_id = 3;
        // $activity->longitude = 0;
        // $activity->latitude = 0;
        // $activity->event_id = 1;
        // $activity->type_id = 1;
        // $activity->modified_date = date('Y-m-d h:m:s');
        // $activity->is_approved = 'Y';

        $this->activityRepository->add($activity);
        redirect(base_url().'activity', 'refresh');
//        header('Content-Type: application/json');
    }

    public function addComment()
    {
        $activity = $this->activityRepository->find(
            new ActivityId($this->post('activity_id'))
        );

        if(empty($activity))
        {
            echo json_encode( ResponseDto::failed('Activity could no be found'));
        }

        $resource = $this->context->users()->find($this->post('resource_id'));

        if(empty($resource))
        {
            echo json_encode( ResponseDto::failed('Resource could no be found'));
        }

        $comment = new Model\ActivityComments();
        $comment->activity_id = $activity->getId();
        $comment->comments = $this->post('comment');
        $comment->commented_by = $resource->getId();
        $comment->commented_date = date('Y-m-d h:m:s');
        $this->context->activityComments()->add($comment);
        $this->resourceRepository->addNotification($activity->getId(), $activity->technician_id);
    }
    
    public function activity_grid(){
        //Table Columns
        $aColumns = array('id', 'description', 'technician_name', 'customer_name', 'event_name', 'assigne_date', 'progress');
        //Fix Search
        $aColumnsWhere = array('technician_id', 'manager_id');
        $aGridData['sSearch_where'] = $this->current_user->getId();

        // Grid Data
        $aGridData['iDisplayStart'] = $this->input->get_post('iDisplayStart', true);
        $aGridData['iDisplayLength'] = $this->input->get_post('iDisplayLength', true);
        $aGridData['iSortCol_0'] = $this->input->get_post('iSortCol_0', true);
        $aGridData['iSortingCols'] = $this->input->get_post('iSortingCols', true);
        $aGridData['sSearch'] = $this->input->get_post('sSearch', true);
        $aGridData['sEcho'] = $this->input->get_post('sEcho', true);
        

        
        
        // -- Ordering
        if(isset($aGridData['iSortCol_0'])){
            for($i=0; $i<intval($aGridData['iSortingCols']); $i++){
                $aGridData['iSortCol_'.$i]  = $this->input->get_post('iSortCol_'.$i, true); 
                $aGridData['bSortable_'.$i] = $this->input->get_post('bSortable_'.intval($aGridData['iSortCol_'.$i]), true);
                $aGridData['sSortDir_'.$i]  = $this->input->get_post('sSortDir_'.$i, true);
            }
        }
        
        // -- Filtering
        if(isset($aGridData['sSearch']) && !empty($aGridData['sSearch'])){
            for($i=0; $i<count($aColumns); $i++){
                $aGridData['bSearchable_'.$i] = $this->input->get_post('bSearchable_'.$i, true);
            }
        }
        
        echo json_encode($this->context->activitiesGrid()->fetchForServerSideGridWhere($aGridData,$aColumns,$aColumnsWhere));
    }
}