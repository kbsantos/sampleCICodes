<?php
namespace ResourceTrackerSolution\ResourceManagement\Infrastructure\Data\Repositories;


use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter\ResourceManagementContext;
use ResourceTrackerSolution\SharedDatabaseManagementTools\Model\Users;

class ResourceRepository
{
    private $context;

    public function __construct(ResourceManagementContext $context)
    {
        $this->context = $context;
    }

    public function add(Users $entity)
    {
        $this->context->users()->add($entity);
    }

    public function find($id)
    {
        $oResource = $this->context->users()->find($id);
        if(trim($oResource->address_location) <> ''){
            $oLocation = $this->context->location()->find((string) $oResource->address_location);
            $oResource->location_label = $oLocation->display_label;            
        }
        unset($oLocation);
        return $oResource;
    }

    public function fetch()
    {
        echo '<pre>';
        return $this->context->users()->fetch();
    }

    public function update(Users $entity)
    {
        $this->context->users()->update($entity);
    }

    public function remove($id)
    {
        $user =  $this->context->users()->find($id);

        $this->context
            ->users()
            ->update($user->remove());
    }
    
    public function findUsernamePassword($username, $password)
    {
        return $this->context
            ->db
            ->select('`id`,
                    `fname`,
                    `mname`,
                    `lname`,
                    `bday`,
                    `gender`,
                    `email`,
                    `telno`,
                    `celno`,
                    `address_location`,
                    `address`,
                    `role_id`,
                    `reported_to`,
                    `status`,
                    `enrolled_by`,
                    `enrolled_date`,
                    `modified_by`,
                    `modified_date`, ')
            ->from('Users')
            ->where('username', $username)
            ->where('password', $password)
            ->where('status', 'Active')
            ->get()
            ->row(0, (string) $this->context->users());
    }

    public function findEmail($email)
    {
        return $this->context
            ->db
            ->select('*')
            ->from('Users')
            ->where('email', $email)
            ->where('status', 'Active')
            ->get()
            ->row(0, (string) $this->context->users());
    }
    
    public function fetchForServerSideGrid($aGridData,$aColumns,$sTable,$sWhere=null)
    {
        if($sWhere !== null) 
        {
              $this->context->db->where($sWhere);
        }
        
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
                if($aRow[$col] == NULL || $aRow[$col] == "")
                    $aRow[$col] = "-";
                $row[] = $aRow[$col];
            }
            $output['aaData'][] = $row;
        }
        
        return $output;
    }
    
    public function fetchLookUpProvince($aGridData,$aColumns,$sTable,$sWhere=null)
    {
        if($sWhere !== null) 
        {
              $this->context->db->where($sWhere);
        }
        
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
                if($aRow[$col] == NULL || $aRow[$col] == "")
                    $aRow[$col] = "-";
                $row[] = $aRow[$col];
            }
            $output['aaData'][] = $row;
        }
        
        return $output;
    }

    public function fetchTechnicianId()
    {
        $role = $this->context
                ->db
                ->select('id')
                ->from('Roles')
                ->where('title', 'Technician')
                ->get()
                ->row(0);
            
            if(empty($role)) return;
            return $role->id;
    }

    public function fetchProvinceId($id)
    {
        $province = $this->context
                ->db
                ->select('province')
                ->from('Province')
                ->where('id', $id)
                ->get()
                ->row();
            if(empty($role)) return;
            return $province->province;
    }
}