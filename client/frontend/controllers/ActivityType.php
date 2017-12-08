<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use ResourceTrackerSolution\SharedDatabaseManagementTools\Model;
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;
use ResourceTrackerSolution\ResourceTracker\Infrastructure\Data\Repositories\ActivityRepository;

class ActivityType extends MY_Controller {

    private $activityRepository;
    private $context;
    private $repository;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->context = new CodeIgniter\ResourceManagementContext();
        $this->repository = new ActivityRepository($this->context);
    }

	public function index()
	{
        // $this->context->activityType()->fetch();
        $aPassData['pageTitle'] = "Activity Type";
        $this->load->view('pages/activity-type/activity_type_list',$aPassData);          
    }

    public function detail()
    {
        $id = intval($this->input->get_post('id'));
        $oActivityType = $this->context->activityType()->find($id);
        echo json_encode($oActivityType);
    }

    public function add(){
        $type = new Model\ActivityType();
        $type->title = $this->input->get_post('add_at_title');
        $type->description = $this->input->get_post('add_at_description');
        $type->type = $this->input->get_post('add_at_type');
        $type->is_for_approval = $this->input->get_post('add_at_opt_approval');
        $type->is_teritorial = $this->input->get_post('add_at_opt_teritory');
        $this->context->activityType()->add($type);
        redirect('activityType');
    }

    public function update(){
        $type = $this->context->activityType()->find($this->input->get_post('edit_at_id'));
        $type->title = $this->input->get_post('edit_at_title');
        $type->description = $this->input->get_post('edit_at_description');
        $type->type = $this->input->get_post('edit_at_type');
        $type->is_for_approval = $this->input->get_post('edit_at_opt_approval');
        $type->is_teritorial = $this->input->get_post('edit_at_opt_teritory');
        $this->context->activityType()->update($type);
        redirect('activityType');
    }
    

    public function remove($id)
    {
        $this->context->activityType()->remove($id);
    }
    
    public function validate(){
    
        $this->form_validation->set_rules('title', 'Title', 'required');
        echo json_encode(array('msg'=>$this->validate_me()));
    }
    
    private function validate_me(){
        $sMessage = "";
        if ($this->form_validation->run() == FALSE){
           $sMessage .= validation_errors();
        }
        else{
            $sMessage .= 'success';    
        }
        return $sMessage;
    }


    public function serverSideGrid(){
        //Table Name
        $sTable = 'Activity_Type';
        
        //Table Columns
        $aColumns = array('id', 'title', 'description', 'is_for_approval', 'is_teritorial');
        
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
        
        $aResult = $this->repository->fetchForServerSideGrid($aGridData,$aColumns,$sTable);
        echo json_encode($aResult);
    }
    
}