<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use ResourceTrackerSolution\SharedDatabaseManagementTools\Model;
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;
use ResourceTrackerSolution\ResourceManagement\Infrastructure\Data\Repositories;

class ResourceManagement extends MY_Controller {
    
    private $context;
    private $repository;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->context = new CodeIgniter\ResourceManagementContext();
        $this->repository = new Repositories\ResourceRepository($this->context);
        
    }

    public function index()
    {
        $aPassData['pageTitle'] = "Sales Representative List";
        $this->load->view('pages/user/resource_management',$aPassData);  
    }
    
    public function add()
    {
        $assigned_province = $this->repository->fetchProvinceId($this->input->get_post('add_resource_assigned_province_id'));
        $resource = new Model\Users();
        $resource->fname                = $this->input->get_post('add_resource_fname');
        $resource->mname                = $this->input->get_post('add_resource_mname');
        $resource->lname                = $this->input->get_post('add_resource_lname');
        $resource->bday                 = date("Y-m-d",strtotime($this->input->get_post('add_resource_bday')));
        $resource->gender               = $this->input->get_post('add_resource_gender');
        $resource->email                = $this->input->get_post('add_resource_email');
        $resource->username             = $this->input->get_post('add_resource_email');
        $resource->celno                = $this->input->get_post('add_resource_celno');
        $resource->telno                = $this->input->get_post('add_resource_telno');
        $resource->status               = $this->config->item('defualt_users_status');
        $resource->role_id              = $this->repository->fetchTechnicianId();
        $resource->password             = $this->config->item('defualt_users_password');
        $resource->address_location     = $this->input->get_post('resource_add_loc_id');
        $resource->assigned_province    = $assigned_province;
        $resource->assigned_province_id = $this->input->get_post('add_resource_assigned_province_id');
        $resource->address              = $this->input->get_post('add_resource_address');
        $resource->enrolled_by          = $this->session->userdata('userId');
        $resource->enrolled_date        = $this->mysql_date_format(now());
        
        $this->repository->add($resource);
        redirect("resourceManagement");
    }
    
    public function update() 
    {
        $assigned_province = $this->repository->fetchProvinceId($this->input->get_post('edit_resource_assigned_province_id'));
        var_dump($_REQUEST);
        $resource = $this->repository->find($this->input->get_post('edit_resource_id'));
        $resource->fname                = $this->input->get_post('edit_resource_fname');
        $resource->mname                = $this->input->get_post('edit_resource_mname');
        $resource->lname                = $this->input->get_post('edit_resource_lname');
        $resource->bday                 = date("Y-m-d",strtotime($this->input->get_post('edit_resource_bday')));
        $resource->gender               = $this->input->get_post('edit_resource_gender');
        $resource->email                = $this->input->get_post('edit_resource_email');
        $resource->username             = $this->input->get_post('edit_resource_email');
        $resource->celno                = $this->input->get_post('edit_resource_celno');
        $resource->telno                = $this->input->get_post('edit_resource_telno');
        $resource->status               = $this->config->item('defualt_users_status');
        $resource->role_id              = $this->repository->fetchTechnicianId();
        $resource->password             = $this->config->item('defualt_users_password');
        $resource->address_location     = $this->input->get_post('resource_edit_loc_id');
        $resource->assigned_province    = $assigned_province;
        $resource->assigned_province_id = $this->input->get_post('edit_resource_assigned_province_id');
        $resource->address              = $this->input->get_post('edit_resource_address');
        $resource->enrolled_by          = $this->session->userdata('userId');
        $resource->enrolled_date        = $this->mysql_date_format(now());
        $this->repository->update($resource);
        
        redirect("resourceManagement");
    }
    
    public function delete()
    {
        
    }
    
    public function detail()
    {
        $oResource = $this->repository->find($this->input->get_post('id'));
        $oResource->bday = $this->sys_date_format($oResource->bday);
        echo json_encode($oResource);
    }
    
    public function validate()
    {
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        //$this->form_validation->set_rules('mname', 'Middle Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules('celno', 'Mobile Number', 'required');
        $this->form_validation->set_rules('telno', 'Telephone Number', 'required');
        // $this->form_validation->set_rules('add_loc', 'Address Location', 'required');
       
        echo json_encode(array('msg'=>$this->set_validation_return()));
    }
    
    private function set_validation_return()
    {
        $sMessage = "";
        
        if ($this->form_validation->run() == FALSE)
        {
            
           $sMessage .= validation_errors();
        }
        else
        {
            $sMessage .= 'success';    
        }
        
        return $sMessage;
    }
    
    public function serverSideGrid(){
        //Table Name
        $sTable = 'view_resource_grid';
        
        $sWhere = array('role_id'=> 2);
        
        //Table Columns
        $aColumns = array('id', 'lname', 'fname', 'mname', 'email', 'contacts');
        
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
        
        $aResult = $this->repository->fetchForServerSideGrid($aGridData,$aColumns,$sTable, $sWhere);
        echo json_encode($aResult);
    }
    
    // public function serverSideGridLocation(){
    //     //Table Name
    //     $sTable = 'Location';
        

    //     //Table Columns
    //     $aColumns = array('id', 'display_label');
        
    //     // Grid Data
    //     $aGridData['iDisplayStart'] = $this->input->get_post('iDisplayStart', true);
    //     $aGridData['iDisplayLength'] = $this->input->get_post('iDisplayLength', true);
    //     $aGridData['iSortCol_0'] = $this->input->get_post('iSortCol_0', true);
    //     $aGridData['iSortingCols'] = $this->input->get_post('iSortingCols', true);
    //     $aGridData['sSearch'] = $this->input->get_post('sSearch', true);
    //     $aGridData['sEcho'] = $this->input->get_post('sEcho', true);
        
    //     // -- Ordering
    //     if(isset($aGridData['iSortCol_0'])){
    //         for($i=0; $i<intval($aGridData['iSortingCols']); $i++){
    //             $aGridData['iSortCol_'.$i]  = $this->input->get_post('iSortCol_'.$i, true); 
    //             $aGridData['bSortable_'.$i] = $this->input->get_post('bSortable_'.intval($aGridData['iSortCol_'.$i]), true);
    //             $aGridData['sSortDir_'.$i]  = $this->input->get_post('sSortDir_'.$i, true);
    //         }
    //     }
        
    //     // -- Filtering
    //     if(isset($aGridData['sSearch']) && !empty($aGridData['sSearch'])){
    //         for($i=0; $i<count($aColumns); $i++){
    //             $aGridData['bSearchable_'.$i] = $this->input->get_post('bSearchable_'.$i, true);
    //         }
    //     }
        
    //     $aResult = $this->repository->fetchForServerSideGrid($aGridData,$aColumns,$sTable);
    //     echo json_encode($aResult);
    // }

    public function serverSideGridProvince(){
        //Table Name
        $sTable = 'Province';
        
        //Table Columns
        $aColumns = array('id', 'province');
        
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
        
        $aResult = $this->repository->fetchLookUpProvince($aGridData,$aColumns,$sTable);
        echo json_encode($aResult);
    }
}
