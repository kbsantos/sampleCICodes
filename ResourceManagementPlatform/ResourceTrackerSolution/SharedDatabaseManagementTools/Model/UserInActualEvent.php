<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

class UserInActualEvent implements IEntity
{
    public $user_id;
    public $actual_event_id;
    public $start_date;
    public $end_date;
    public $status;
    public $notes;

    public function __toString()
    {
        return 'user_in_actual_event';
    }

    public function getId()
    {
        return;
    }

    public function setId($id)
    {
    }
}