<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use ResourceTrackerSolution\SharedDatabaseManagementTools\Model;
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;
use ResourceTrackerSolution\ResourceManagement\Infrastructure\Data\Repositories;

class User extends MY_Controller {

    private $context;
    private $repository;

    public function __construct()
    {
        parent::__construct();
        $this->context = new CodeIgniter\ResourceManagementContext();
        $this->repository = new Repositories\ResourceRepository($this->context);
        //@todo replace with session value of user id
        $this->current_user = $this->repository->find(1);
    }

    public function index()
    {
        var_dump($this->repository->fetch());
        
        $aPassData['pageTitle'] = "Resource";
        $this->load->view('pages/user/user_list',$aPassData);  
    }

    public function detail($id)
    {
        $this->repository->find($id);
    }

    public function add()
    {
        $user = new Model\Users();
        $user->address = 'address';
        $this->repository->add($user);
        $this->load->view('pages/user/user_add'); 
    }

    public function update($id)
    {
        $user = $this->repository->find($id);
        $this->repository->update($user);

    }

    public function remove($id)
    {
        $this->repository->remove($id);
    }
    
    public function profile(){
        
        if($this->input->post()){
            
                $user = new stdClass();
                $user->username = $this->input->get_post('username');
                $user->fname = $this->input->get_post('fname');
                $user->mname = $this->input->get_post('mname');
                $user->lname = $this->input->get_post('lname');
                $user->bday =  $this->input->get_post('bday');
                $user->gender = $this->input->get_post('gender');
                $user->email = $this->input->get_post('email');
                $user->celno = $this->input->get_post('celno');
                $user->telno = $this->input->get_post('telno');
                $user->address = $this->input->get_post('address');
                
                $user->modified_date = $this->mysql_date_format(now());
                
                $this->context->db->where('id', $this->session->userdata("userId"));
                $this->context->db->update("Users", $user);
                
        }
        
        $aPassData['pageTitle'] = "Profile";
 
        $aPassData["oUser"] = $this->repository->find($this->session->userdata("userId"));
        
        $this->load->view('pages/profile/profile_view',$aPassData);
        
    }
}
