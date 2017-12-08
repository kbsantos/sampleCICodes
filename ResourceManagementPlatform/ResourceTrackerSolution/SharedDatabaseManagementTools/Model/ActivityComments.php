<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

final class ActivityComments implements IEntity
{
    public $id;
    public $activity_id;
    public $comments;
    public $commented_by;
    public $commented_date;

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
        return 'activity_comments';
    }
}