<?php
namespace ResourceTrackerSolution\ResourceTracker\Model\Activities;


use ValueObjects\Geography\Coordinate;

final class Activity
{
    protected $id;
    protected $description;
    protected $status;
    protected $event_id;
    protected $type_id;
    protected $customer_id;
    protected $agent_id;
    protected $manager_id;
    protected $longitude;
    protected $latitude;
    protected $ellipsoid;
    protected $create_date;
    protected $create_user_id;
    protected $update_date;
    protected $update_user_id;
    private $customer;
    private $type;
    private $agent;
    private $manager;
    private $attachments = array();
    private $comments = array();

    public function __construct(ActivityId $id)
    {
        $this->id = (string) $id;
    }

    public static function log(ActivityId $id,
                               $description,
                               ActivityType $type,
                               $agent_id,
                               $manager_id,
                               $customer_id,
                               $status,
                               Coordinate $coordinate = null,
                               array $attachments = array(),
                               $create_date = '')
    {

        $activity = new Activity($id);
        $activity->setDescription($description);
        $activity->setTypeId($type->getId());
        $activity->setAgentId($agent_id);
        $activity->setManagerId($manager_id);
        $activity->setCustomerId($customer_id);
        $activity->setCreateDate($create_date);
        $activity->setStatus($status);

        if($type->needsApproval()){
            //raise event
        }

        if(!empty($coordinate)){
            $activity->setLongitude($coordinate->getLongitude());
            $activity->setLatitude($coordinate->getLatitude());
        }

        if(!empty($attachments)){
            $activity->setAttachments($attachments);
        }

        return $activity;
    }

    public function setAgentId($id)
    {
        $this->agent_id = $id;
    }

    public function setManagerId($id)
    {
        $this->manager_id = $id;
    }

    public function addAttachment(Attachment $attachment)
    {
        $this->attachments[] = $attachment;
    }

    public function addComment(Comment $comment)
    {
        $this->comments[] = $comment;
    }

    public function approve()
    {
        $this->status = 'Approved';
    }

    public function updateCoordinate(Coordinate $coordinate)
    {
        $this->setCoordinate($coordinate);
    }

    public function setCoordinate(Coordinate $coordinate)
    {
        $this->longitude = $coordinate->getLongitude();
        $this->latitude = $coordinate->getLatitude();
        $this->ellipsoid = $coordinate->getEllipsoid();
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setEventId($id)
    {
        $this->event_id = $id;
    }

    public function setTypeId($id)
    {
        $this->type_id = $id;
    }

    public function setCustomerId($id)
    {
        $this->customer_id = $id;
    }

    public function setResourceId($id)
    {
        $this->resource_id = $id;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function setEllipsoid($ellipsoid)
    {
        $this->ellipsoid = $ellipsoid;
    }

    public function setCreateDate($date)
    {
        $this->create_date = $date;
    }

    public function setAttachments(array $attachments)
    {
        $this->attachments = $attachments;
    }

    public function changeStatus($status)
    {
        $this->status = $status;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStatus()
    {
        return $this->status;
    }
}