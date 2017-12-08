<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use ResourceTrackerSolution\SharedDatabaseManagementTools\Model;
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;
use ResourceTrackerSolution\ResourceManagement\Infrastructure\Data\Repositories;

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->context = new CodeIgniter\ResourceManagementContext();
        $this->repository = new Repositories\ResourceRepository($this->context);
    }

	public function index()
	{
	   $user = $this->input->post('login_username');
	   if(isset($user)){
	        $pass = $this->input->post('login_password');
            $this->login($user,$pass); 
	   }
	   else{
	       $this->load->view('login');     
	   }
	}

    private function login($username, $password)
    {
        $user = $this->repository->findUsernamePassword($username,$password);
        if(!is_null($user)){
            $this->session->set_userdata(array('userId'=>$user->id));
            redirect('home');
        }
        else{
            $aData['message'] = "Either User name or Password provided was incorrect!";
            $this->load->view('login',$aData);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
