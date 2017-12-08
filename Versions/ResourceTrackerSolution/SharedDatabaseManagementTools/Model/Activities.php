<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

final class Activities implements IEntity
{
    public $id;
    public $title;
    public $customer_id;
    public $event_id;
    public $description;
    public $technician_id;
    public $manager_id;
    public $location_id;
    public $address;
    public $is_approved;
    public $approved_by;
    public $approved_date;
    public $enrolled_by;
    public $enrolled_date;
    public $modified_by;
    public $modified_date;
    public $Activity_Type_id;
    public $Activity_Type_Location_id;
    public $Activity_Type_Location_Location_Assigments_id;
    public $Activity_Comments_id;
    public $Activity_Attachments_id;
    public $type_id;

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
        return 'Activities';
    }
}