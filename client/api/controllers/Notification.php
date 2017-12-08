<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;
use ResourceTrackerSolution\ResourceManagement\Infrastructure\Data\Repositories;

require APPPATH . 'libraries/REST_Controller.php';

class Notification extends REST_Controller
{
    private $context;
    private $repository;

    public function __construct()
    {
        parent::__construct();
        $this->context = new CodeIgniter\ResourceManagementContext();
    }

    public function index_get($resource_id)
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