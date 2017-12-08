<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;

class Location extends MY_Controller {
    private $context;
    
    public function __construct()
    {
        parent::__construct();
        $this->context = new CodeIgniter\ResourceManagementContext();
    }

    public function index()
    {
        $aPassData['pageTitle'] = "Location";
        $this->load->view('pages/user/location',$aPassData);  
    }
    
    public function grid_location(){
        
        //Table Columns
        $aColumns = array('id', 'region_code', 'province', 'city', 'brangay');
        
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
        
       echo json_encode($this->context->location()->fetchForServerSideGrid($aGridData,$aColumns));
        
    }
    
     public function search(){
           $oLocation = $this->context->db                       
                             ->select('id,display_label')
                             ->from('Location')
                             ->like('display_label', $this->input->get_post('term', true),  'right')
                             //->limit(10)
                             ->get()->result((string) $this->context->location());
            
            $aReturn = array();
            foreach($oLocation as $n=>$oLoc){
                $aReturn[$n]['id'] = $oLoc->id;
                $aReturn[$n]['label'] = $oLoc->display_label;
            }
                             
            echo json_encode($aReturn);
     }   
}
