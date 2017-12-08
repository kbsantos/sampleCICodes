<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $aPassData['pageTitle'] = "Company";
        $this->load->view('pages/user/company',$aPassData);  
    }

   
}
