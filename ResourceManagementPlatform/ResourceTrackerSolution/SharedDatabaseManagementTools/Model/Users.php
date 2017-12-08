<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

final class Users implements IEntity
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
    public $address_location;
    public $assigned_province_id;
    public $assigned_province;
    public $address;
    public $role_id;
    public $reported_to;
    public $status;
    public $enrolled_by;
    public $enrolled_date;
    public $modified_by;
    public $modified_date;
    public $username;
    public $password;
    public $picture;
    
    public function remove()
    {
        $this->status = 'NotActive';
        return $this;
    }

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
        return 'Users';
    }
}