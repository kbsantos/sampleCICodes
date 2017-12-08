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
    private $menu;
    private $activityReport;
    private $actualEvents;
    private $businessProcesses;
    private $events;
    private $formActualEventValues;
    private $formFields;
    private $transactions;
    private $userInActualEvent;
    private $activitiesGrid;

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
        $this->province = new SetTable(new Model\Province(), $this->db);
        $this->cities = new SetTable(new Model\Cities(), $this->db);
        $this->location_assignments = new SetTable(new Model\LocationAssignments(), $this->db);
        $this->users = new SetTable(new Model\Users(), $this->db);
        $this->menu = new SetTable(new Model\Menu(), $this->db);
        $this->activityReport = new SetTable(new Model\ActivityReport(), $this->db);
        $this->actualEvents = new SetTable(new Model\ActualEvents(), $this->db);
        $this->businessProcesses = new SetTable(new Model\BusinessProcesses(), $this->db);
        $this->events = new SetTable(new Model\Events(), $this->db);
        $this->formActualEventValues = new SetTable(new Model\FormActualEventValues(), $this->db);
        $this->formFields = new SetTable(new Model\FormFields(), $this->db);
        $this->transactions = new SetTable(new Model\Transactions(), $this->db);
        $this->userInActualEvent = new SetTable(new Model\UserInActualEvent(), $this->db);
        $this->activitiesGrid = new SetTable(new Model\ActivitiesGrid(), $this->db);
    }

    public function activitiesGrid()
    {
        return $this->activitiesGrid;
    }
    
    public function actualEvents()
    {
        return $this->actualEvents;
    }

    public function businessProcesses()
    {
        return $this->businessProcesses;
    }

    public function events()
    {
        return $this->events;
    }

    public function formActualEventValues()
    {
        return $this->formActualEventValues;
    }

    public function formFields()
    {
        return $this->formFields;
    }

    public function transactions()
    {
        return $this->transactions;
    }

    public function userInActualEvent()
    {
        return $this->userInActualEvent;
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

    public function province()
    {
        return $this->province;
    }

    public function cities()
    {
        return $this->cities;
    }

    public function locationAssignments()
    {
        return $this->location_assignments;
    }

    public function users()
    {
        return $this->users;
    }
    
    public function menu()
    {
        return $this->menu;
    }
    
    public function activityReport()
    {
        return $this->activityReport;
    }
}