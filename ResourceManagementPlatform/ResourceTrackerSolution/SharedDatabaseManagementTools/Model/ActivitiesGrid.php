<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

final class ActivitiesGrid implements IEntity
{
 
    public function getId()
    {
        // return $this->id;
    }

    public function setId($id)
    {
        // $this->id = $id;
    }

    public function __toString()
    {
        return 'view_activity_grid';
    }
}