<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

class ActualEvents implements IEntity
{
    public $id;
    public $source_id;
    public $transaction_id;
    public $status;
    public $source;

    public function __toString()
    {
        return 'actual_events';
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