<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use ResourceTrackerSolution\ResourceTracker\Application\Activities;
use ResourceTrackerSolution\ResourceTracker\Infrastructure\Data\Repositories;
use ResourceTrackerSolution\ResourceTracker\Model\Activities as Entity;
use ValueObjects\Person;
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;
use ResourceTrackerSolution\SharedDatabaseManagementTools\Model;
use ResourceTrackerSolution\ResourceManagement\Infrastructure\Data\Repositories as ResourceManagementRepo;
require APPPATH . 'libraries/REST_Controller.php';

class Activity extends REST_Controller {

    private $context;
    private $activityRepository;
    private $resourceRepository;

    public function __construct()
    {
        parent::__construct();
        $this->context = new CodeIgniter\ResourceManagementContext();
        $this->activityRepository = new Repositories\ActivityRepository($this->context);
        $this->resourceRepository = new ResourceManagementRepo\ResourceRepository($this->context);
    }

    public function index_post(){
        
        $resource_id = $this->post('resource_id');
        $id = $this->post('id');
        
        if(empty($resource_id))
        {
            $this->response(ResponseDto::failed('No activities were found'), REST_Controller::HTTP_NOT_FOUND);
        }

        if(!empty($id))
        {
            $activities = $this->activityRepository->findWithComments($id);
            $this->response(ResponseDto::success($activities), REST_Controller::HTTP_OK);
        }

        $activities = $this->activityRepository->fetchByResourceId($resource_id);
        $this->response(ResponseDto::success($activities), REST_Controller::HTTP_OK);

    }

	public function log_post()
	{
        $type = $this->activityRepository->findType($this->post('type'));
        if(empty($type))
        {
            $this->response(ResponseDto::failed('No activities were found'), REST_Controller::HTTP_NOT_FOUND);
        }

        $activity = new Model\Activities();
        $activity->description = $this->post('description');
        $activity->manager_id = $this->post('manager_id');
        $activity->technician_id = $this->post('technician_id');
        $activity->customer_id = $this->post('customer_id');
        $activity->status = $this->post('status');
        $activity->longitude = $this->post('longitude');
        $activity->latitude = $this->post('latitude');
        $activity->type_id = $type->getId();
        $activity->modified_date = date('Y-m-d h:m:s');
        $activity->is_approved = 'Y';
        $this->activityRepository->add($activity);
        $this->response(ResponseDto::success(['id'=>$activity->getId()]), REST_Controller::HTTP_OK);
//        $app = new Activities\Activity($this->activityRepository, $this->current_user);
//        $activity = $app->log('description', 1,1,1,1,'In Progress',123546,123546);
//        echo sprintf('New activity added %s with status %s', $activity->getId(), $activity->getStatus());
	}

    public function comment_post()
    {
        $activity = $this->activityRepository->find(
            new Entity\ActivityId($this->post('activity_id'))
        );

        if(empty($activity))
        {
            $this->response(ResponseDto::failed('Activity could no be found'), REST_Controller::HTTP_NOT_FOUND);
        }

        $resource = $this->context->users()->find($this->post('resource_id'));

        if(empty($resource))
        {
            $this->response(ResponseDto::failed('Resource could no be found'), REST_Controller::HTTP_NOT_FOUND);
        }

        $comment = new Model\ActivityComments();
        $comment->activity_id = $activity->getId();
        $comment->comments = $this->post('comment');
        $comment->commented_by = $resource->getId();
        $comment->commented_date = date('Y-m-d h:m:s');
        $this->context->activityComments()->add($comment);
        $this->resourceRepository->addNotification($activity->getId(), $activity->technician_id);
        $this->response(ResponseDto::success(['id'=> $comment->getId()]), REST_Controller::HTTP_OK);
    }
    
    
}