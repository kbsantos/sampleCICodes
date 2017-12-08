<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResourceTracker extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $aPassData['pageTitle'] = "Resource Tracker";
        
        $this->load->view('pages/resource-tracker/resource_tracker_notifications',$aPassData);  
    }

   
}
