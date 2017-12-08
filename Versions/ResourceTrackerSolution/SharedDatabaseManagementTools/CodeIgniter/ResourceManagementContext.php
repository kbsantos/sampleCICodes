<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;


use ResourceTrackerSolution\SharedDatabaseManagementTools\Model;

final class ResourceManagementContext extends DbContext
{
    private $customers;
    private $activities;
    private $activity_type;
    private $activity_comments;
    private $activity_attachments;
    private $organization;
    private $notifications;
    private $location;
    private $location_assignments;
    private $users;

    public function __construct()
    {
        $this->customers = new SetTable(new Model\Customers(), $this->db);
        $this->activities = new SetTable(new Model\Activities(), $this->db);
        $this->activity_type = new SetTable(new Model\ActivityType(), $this->db);
        $this->activity_comments = new SetTable(new Model\ActivityComments(), $this->db);
        $this->activity_attachments = new SetTable(new Model\ActivityAttachments(), $this->db);
        $this->organization = new SetTable(new Model\CustomerOrganization(), $this->db);
        $this->notifications = new SetTable(new Model\Notifications(), $this->db);
        $this->location = new SetTable(new Model\Location(), $this->db);
        $this->location_assignments = new SetTable(new Model\LocationAssignments(), $this->db);
        $this->users = new SetTable(new Model\Users(), $this->db);
    }

    public function customers()
    {
        return $this->customers;
    }

    public function activities()
    {
        return $this->activities;
    }

    public function activityType()
    {
        return $this->activity_type;
    }

    public function activityComments()
    {
        return $this->activity_comments;
    }

    public function activityAttachments()
    {
        return $this->activity_attachments;
    }

    public function organization()
    {
        return $this->organization;
    }

    public function notifications()
    {
        return $this->notifications;
    }

    public function location()
    {
        return $this->location;
    }

    public function locationAssignments()
    {
        return $this->location_assignments;
    }

    public function users()
    {
        return $this->users;
    }
}