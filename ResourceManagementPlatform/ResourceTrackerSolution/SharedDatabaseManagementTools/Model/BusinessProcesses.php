<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

class BusinessProcesses implements IEntity
{
    public $id;
    public $next_process_id;
    public $name;
    public $description;
    public $create_date;

    public function __toString()
    {
        return 'business_processes';
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
