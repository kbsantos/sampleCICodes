<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

final class ActivityType implements IEntity
{

    public $id;
    public $title;
    public $description;
    public $type;
    public $is_for_approval;
    public $is_teritorial;

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
        return 'Activity_Type';
    }
}