<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use ResourceTrackerSolution\SharedDatabaseManagementTools\Model;
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;
use ResourceTrackerSolution\CustomerManagement\Infrastructure\Data\Repositories;

class Customer extends MY_Controller {

    private $context;
    private $repository;
    

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->context = new CodeIgniter\ResourceManagementContext();
        $this->repository = new Repositories\CustomerRepository($this->context);
        $this->user_id = $this->session->userdata('userId');

        // if($this->user->role_id != 1){
            $this->province_id = $this->user->assigned_province_id;
            $this->province = $this->user->assigned_province;
        // }else{
        //     $this->province_id = null;
        //     $this->province = 'All';
        // }

        //$this->user->assigned_province;
    }   


    public function index(){
        $aPassData['pageTitle'] = "Farmer List";
        $this->load->view('pages/customer/customer_list', $aPassData);
    }
    
    public function serverSideGrid(){
        
        //Table Name
        $sTable = 'view_customer_grid';
        
        //Table Columns
        // $aColumns = array('id', 'name', 'email', 'contacts', 'address', 'status', 'enrolled_date');
        $aColumns = array('id', 'lname', 'fname', 'mname', 'city', 'contacts', 'enrolled_date', 'status');
        
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
        
        $aResult = $this->repository->fetchForServerSideGrid($aGridData,$aColumns,$sTable,$this->user_id);
        echo json_encode($aResult);
    }
    
    public function serverSideGridOrganization(){
        //Table Name
        $sTable = 'Customer_Organization';
        
        //Table Columns
        $aColumns = array('id', 'title','description','status',);
        
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
        
        $aResult = $this->repository->fetchForServerSideGrid($aGridData,$aColumns,$sTable,$this->user_id);
        echo json_encode($aResult);
    }
    
    public function serverSideGridLocation(){
        //Table Name
        $sTable = 'Location';
        
        //Table Columns
        $aColumns = array('id', 'display_label');
        
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
        
        $aResult = $this->repository->fetchForServerSideGrid($aGridData,$aColumns,$sTable,null);
        echo json_encode($aResult);
    }

    public function serverSideGridCities(){
        //Table Name
        $sTable = 'Cities';
        //Table Columns
        $aColumns = array('id', 'city');
        
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
        
        $aResult = $this->repository->fetchLookUpCity($aGridData,$aColumns,$sTable,$this->id);
        echo json_encode($aResult);
    }

    public function detail(){
        $oCustomer = $this->repository->find($this->input->get_post('id'));
        $oCustomer->bday = $this->sys_date_format($oCustomer->bday);
       echo json_encode($oCustomer);
    }
     
    public function validate_org(){
        $this->form_validation->set_rules('org_title', 'Organization Title', 'required');
        $this->form_validation->set_rules('add_org_loc_id', 'Address Location', 'required');
        $this->form_validation->set_rules('add_org_status', 'Status', 'required');
        
        $sMessage = "";
        if ($this->form_validation->run() == FALSE){
           $sMessage .= validation_errors();
        }
        else{
            
            $data = array('customer_id' => $this->input->post('org_customer_id'),
                          'title' => $this->input->post('org_title'),
                          'description' => $this->input->post('add_org_description'),
                          'address_location' => $this->input->post('add_org_loc_id'),
                          'address' => $this->input->post('add_org_address'),
                          'remarks' => $this->input->post('add_org_remarks'),
                          'status' => $this->input->post('add_org_status'));
            
            $this->repository->add_organization($data);
            $sMessage .= 'success';    
        }
        
        echo json_encode(array('msg'=>$sMessage));
    }

    public function validate(){
        
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        // $this->form_validation->set_rules('lname', 'Last Name', 'required');
        // $this->form_validation->set_rules('celno', 'Mobile Number', 'required');
        // $this->form_validation->set_rules('add_loc', 'Address Location', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
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

    public function add(){
        
        $customer = new Model\Customers();
        $customer->fname = $this->input->get_post('add_customer_fname');
        $customer->mname = $this->input->get_post('add_customer_mname');
        $customer->lname = $this->input->get_post('add_customer_lname');
        $customer->bday =  date("Y-m-d",strtotime($this->input->get_post('add_customer_bday')));
        $customer->gender = $this->input->get_post('add_customer_gender');
        $customer->email = $this->input->get_post('add_customer_email');
        $customer->celno = $this->input->get_post('add_customer_celno');
        $customer->telno = $this->input->get_post('add_customer_telno');
        $customer->crop = $this->input->get_post('add_customer_crop');
        // $customer->address_location = $this->input->get_post('add_customer_add_loc_id');
        $customer->address = $this->input->get_post('add_customer_address');
        $customer->province_id = $this->province_id;
        $customer->city_id = $this->input->get_post('add_customer_cities_id');
        $customer->status = $this->input->get_post('add_customer_status'); 
        $customer->fertilizer_program = $this->input->get_post('add_customer_fertilizer'); 
        $customer->enrolled_by = $this->session->userdata('userId');
        $customer->enrolled_date = $this->mysql_date_format(now());
        $this->repository->add($customer);
        redirect("customer");
    }
    
    public function update()
    {
        $customer = $this->repository->find($this->input->get_post('customer_id'));
        $customer->fname = $this->input->get_post('customer_fname');
        $customer->mname = $this->input->get_post('customer_mname');
        $customer->lname = $this->input->get_post('customer_lname');
        $customer->bday =  date("Y-m-d",strtotime($this->input->get_post('customer_bday')));
        $customer->gender = $this->input->get_post('customer_gender');
        $customer->email = $this->input->get_post('customer_email');
        $customer->celno = $this->input->get_post('customer_celno');
        $customer->telno = $this->input->get_post('customer_telno');
        $customer->crop = $this->input->get_post('customer_crop');
        // $customer->address_location = $this->input->get_post('customer_edit_loc_id');
        $customer->address = $this->input->get_post('customer_address');
        $customer->province_id = $this->province_id;
        $customer->city_id = $this->input->get_post('customer_cities_id');
        $customer->status = $this->input->get_post('customer_status'); 
        $customer->fertilizer_program = $this->input->get_post('customer_fertilizer'); 
        $this->repository->update($customer);
        
        redirect("customer");
    }

    public function remove($id)
    {
        $this->repository->remove($id);
    }
    
    
    public function organization()
	{
		echo json_encode($this->repository->findOrganization($this->input->get_post('cus_id')));
	}
	
	public function organization_by_label()
	{
	    //$this->repository->findOrganizationByName('gapan')
		echo json_encode($this->repository->findOrganizationByName(''));
	}
	
	public function location_lookup(){
	    
	    echo json_encode($this->repository->search_location(''));
	} 

    public function cities_lookup(){
    
        echo json_encode($this->repository->search_cities(''));
    } 

 //    public function division_lookup(){
        
 //        echo json_encode($this->repository->search_division(''));
 //    }    
}
