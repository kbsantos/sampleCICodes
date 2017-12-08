<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $aPassData['pageTitle'] = "Settings";
        
        $this->load->view('pages/settings/settings_view',$aPassData);  
    }

   
}
