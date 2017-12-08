<?php
namespace ResourceTrackerSolution\ResourceTracker\Application\Activities;

use ResourceTrackerSolution\ResourceTracker\Model\Activities;
use ValueObjects\Geography\Coordinate;
use ValueObjects\Geography\Latitude;
use ValueObjects\Geography\Longitude;
use ValueObjects\Identity\UUID;


class Activity
{

    private $activityRepository;
    private $currentUser;

    public function __construct(Activities\IActivityRepository $activityRepository, Activities\User $current_user)
    {
        $this->activityRepository = $activityRepository;
        $this->currentUser = $current_user;
    }

    public function find($id)
    {
        $this->activityRepository->find(new Activities\ActivityId($id));
    }

    public function listAll()
    {

    }

    public function log($description,
                               $type_name,
                               $agent_id,
                               $manager_id,
                               $customer_id,
                               $status,
                               $latitude = null,
                               $longitude = null,
                               array $attachments = array())
    {
        $type = $this->activityRepository->findTypeName($type_name);
        $type = new Activities\ActivityType($type_id);

        $coordinate = new Coordinate(new Latitude($latitude),new Longitude($longitude) );
        $activity = Activities\Activity::log(new Activities\ActivityId(),
            $description,
            $type,
            $agent_id,
            $manager_id,
            $customer_id,
            $status,
            $coordinate,
            $attachments,
            date('Y-m-d h:m:s'));
        $this->activityRepository->add($activity);
//        return $activity;
    }

    public function addAttachment(Attachment $attachment)
    {
        $this->attachments[] = $attachment;
    }

    public function addComment($user_id, $comment)
    {

    }

    public function remove($id)
    {
        $this->activityRepository->remove(new Activities\ActivityId($id));
    }
}