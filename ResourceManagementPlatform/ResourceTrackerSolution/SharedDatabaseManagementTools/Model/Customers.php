<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

final class Customers implements IEntity
{
    public $id;
    public $fname;
    public $mname;
    public $lname;
    public $bday;
    public $gender;
    public $email;
    public $telno;
    public $celno;
    public $crop;
    public $address_location;
    public $address;
    public $province_id;
    public $city_id;
    public $status;
    public $fertilizer_program;
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
        return 'Customers';
    }
}