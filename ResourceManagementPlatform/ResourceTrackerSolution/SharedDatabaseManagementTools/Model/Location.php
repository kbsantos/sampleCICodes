<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

final class Location implements IEntity
{
    public $id;
    public $region;
    public $region_code;
    public $province;
    public $city;
    public $brangay;
    public $display_label;

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
        return 'Location';
    }
}