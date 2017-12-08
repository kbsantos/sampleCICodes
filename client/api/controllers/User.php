<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;
use ResourceTrackerSolution\ResourceManagement\Infrastructure\Data\Repositories;

require APPPATH . 'libraries/REST_Controller.php';

class User extends REST_Controller
{
    private $context;
    private $repository;

    public function __construct()
    {
        parent::__construct();
        $this->context = new CodeIgniter\ResourceManagementContext();
        $this->repository = new Repositories\ResourceRepository($this->context);
    }

    public function index_get()
    {

        // Display all books
    }

    public function login_post()
    {
        $username = $this->post('username');
        $password = $this->post('password');

        if(empty($username) || empty($password))
        {
            $this->response(ResponseDto::failed('No users were found'), REST_Controller::HTTP_NOT_FOUND);
        }

        $user = $this->repository->findUsernamePassword(urldecode($username), urldecode($password));
        if(empty($user))
        {
            $this->response(ResponseDto::failed('User could not be found'), REST_Controller::HTTP_NOT_FOUND);
        }

        $this->response(ResponseDto::success($user), REST_Controller::HTTP_OK);
    }

    public function login_get($username, $password)
    {

        if(empty($username) || empty($password))
        {
            $this->response(ResponseDto::failed('No users were found'), REST_Controller::HTTP_NOT_FOUND);
        }

        $user = $this->repository->findUsernamePassword(urldecode($username), urldecode($password));
        if(empty($user))
        {
            $this->response(ResponseDto::failed('User could not be found'), REST_Controller::HTTP_NOT_FOUND);
        }

        $this->response(ResponseDto::success($user), REST_Controller::HTTP_OK);
    }
}