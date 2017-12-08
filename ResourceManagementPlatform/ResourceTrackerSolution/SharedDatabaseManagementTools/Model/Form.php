<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

class Form implements IEntity
{
    public $id;
    public $name;
    public $description;
    public $create_date;

    public function __toString()
    {
        return 'form';
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