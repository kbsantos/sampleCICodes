<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

class Transactions implements IEntity
{
    public $id;
    public $event_id;
    public $form_id;
    public $name;
    public $description;
    public $create_date;

    public function __toString()
    {
        return 'transactions';
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
