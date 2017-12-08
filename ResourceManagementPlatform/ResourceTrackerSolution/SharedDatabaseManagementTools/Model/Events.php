<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

class Events implements IEntity
{
    public $id;
    public $next_event_id;
    /**
     * @var
     * eg. Insurance Claim, Onboarding
     */
    public $name;
    public $description;
    public $create_date;

    public function __toString()
    {
        return 'events';
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}