<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;
use ResourceTrackerSolution\CustomerManagement\Infrastructure\Data\Repositories;
require APPPATH . 'libraries/REST_Controller.php';

class Customer extends REST_Controller
{
    private $context;
    private $repository;

    public function __construct()
    {
        parent::__construct();
        $this->context = new CodeIgniter\ResourceManagementContext();
        $this->repository = new Repositories\CustomerRepository($this->context);
    }
    
    public function index_post(){
        
        $customer = $this->repository->fetch();
        
        if(empty($customer))
        {
            $this->response(ResponseDto::failed('Customer could not be found'), REST_Controller::HTTP_NOT_FOUND);
        }

        $this->response(ResponseDto::success($customer), REST_Controller::HTTP_OK);
    }

    public function search_post(){
        
        $name = $this->post('name');
        if(empty($name))
        {
            $this->response(ResponseDto::failed('No custmor were found'), REST_Controller::HTTP_NOT_FOUND);
        }

        $customer = $this->repository->search(urldecode($name));
        if(empty($customer))
        {
            $this->response(ResponseDto::failed('Customer could not be found'), REST_Controller::HTTP_NOT_FOUND);
        }

        $this->response(ResponseDto::success($customer), REST_Controller::HTTP_OK);
    }
    
    public function add_customer(){
        
        $this->response($fname);
        
    }
    
}