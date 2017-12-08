<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use ResourceTrackerSolution\SharedDatabaseManagementTools\Model;
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;
use ResourceTrackerSolution\ResourceTracker\Infrastructure\Data\Repositories\ActivityRepository;

class ActivityList extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $aPassData['pageTitle'] = "Activity List";
        $this->load->view('pages/workflow/activity_list',$aPassData);  
    }

   
}
