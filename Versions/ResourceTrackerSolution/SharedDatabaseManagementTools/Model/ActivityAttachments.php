<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

final class ActivityAttachments implements IEntity
{
    public $id;
    public $activity_id;
    public $titile;
    public $source;
    public $type;
    public $is_deleted;
    public $enrolled_by;
    public $enrolled_date;
    public $modified_by;
    public $modified_date;


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
        return 'Activity_Attachments';
    }
}