<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use ResourceTrackerSolution\ResourceTracker\Application\Activities;
use ResourceTrackerSolution\ResourceTracker\Model\Activities as Entity;
use ValueObjects\Person;
use ResourceTrackerSolution\ResourceTracker\Infrastructure\Data\Repositories;
use ResourceTrackerSolution\SharedDatabaseManagementTools\Model;

class Activity extends CI_Controller {

    private $current_user;
    private $activityRepository;

    public function __construct()
    {
        parent::__construct();
        $db = new \ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter\ResourceManagementContext();
        $db->customers()->find(1);
        $customer = new Model\Customers();
        $customer->fname = 'kris';
        $db->customers()->add($customer);
        
        
        $this->activityRepository = new Repositories\ActivityRepository($db);

//        $customer = new Model\Customers();
//        $customer->setId(null);
//        $customer->fname = 'Andoy';
//        $customer->enrolled_date = date('Y-m-d h:m:s');
//        $customer->modified_date = date('Y-m-d h:m:s');
//        $db->customers()->add($customer);
//
//        $customer = $db->customers()->find( $customer->getId());
//        $db->customers()->update($customer);
        echo '<pre>';
        var_dump(
            $this->activityRepository->findUser(2,'technician')
        );
//        $this->activityRepository = new Repositories\ActivityRepository();
//        $this->current_user = $this->activityRepository->fetchUserById(1);
    }

	public function log()
	{
//        $app = new Activities\Activity($this->activityRepository, $this->current_user);
//        $activity = $app->log('description', 1,1,1,1,'In Progress',123546,123546);
//        echo sprintf('New activity added %s with status %s', $activity->getId(), $activity->getStatus());
	}
}