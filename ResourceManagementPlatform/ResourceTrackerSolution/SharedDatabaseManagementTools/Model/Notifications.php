<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

final class Notifications implements IEntity
{
    public $id;
    public $activity_id;
    public $event_id;
    public $approver_id;
    public $assigner_id;
    public $notification_date;
    public $view_status;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function __toString()
    {
        return 'Location_Assignments';
    }
}