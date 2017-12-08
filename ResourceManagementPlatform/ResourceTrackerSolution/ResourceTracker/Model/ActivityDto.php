<?php
namespace ResourceTrackerSolution\ResourceTracker\Model;


class ActivityDto {

    public $id;
    public $description;
    public $status;
    public $type_id;
    public $technician_id;
    public $technician_name;
    public $manager_name;
    public $manager_id;
    public $longitude;
    public $latitude;
    public $create_date;
    public $event_name;
    public $event_id;
    public $comments = array();
    public $transactions = array();

    public function __toString()
    {
        return get_class($this);
    }
}