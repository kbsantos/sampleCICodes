<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;
use ResourceTrackerSolution\ResourceTracker\Infrastructure\Data\Repositories;

require APPPATH . 'libraries/REST_Controller.php';

class ActivityType extends REST_Controller
{
    private $context;
    private $repository;

    public function __construct()
    {
        parent::__construct();
        $this->context = new CodeIgniter\ResourceManagementContext();
        $this->repository = new Repositories\ActivityRepository($this->context);
    }

    public function index_post()
    {
        $id = $this->post('id');

        if(empty($id))
        {
            $type = $this->context->activityType()->fetch();
            if (!empty($type))
            {
                $this->response(ResponseDto::success($type), REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response(ResponseDto::failed('No types were found'), REST_Controller::HTTP_NOT_FOUND);
            }
        }else{
            $type = $this->context->activityType()->find($id);
            if(empty($type))
            {
                $this->response(ResponseDto::failed('Type could not be found'),
                    REST_Controller::HTTP_NOT_FOUND);
            }
            $this->response(ResponseDto::success($type), REST_Controller::HTTP_OK);
        }
        // Display all books
    }

    public function search_post()
    {
        $type = $this->post('type');
        if(empty($type)){
            $this->response(ResponseDto::failed('No types were found'), REST_Controller::HTTP_NOT_FOUND);
        }

        $result = $this->repository->searchType(urldecode($type));
        if(empty($result)){

            $this->response(ResponseDto::failed('Type could not be found'), REST_Controller::HTTP_NOT_FOUND);
        }

        $this->response(ResponseDto::success($result), REST_Controller::HTTP_OK);
    }
    
   
}