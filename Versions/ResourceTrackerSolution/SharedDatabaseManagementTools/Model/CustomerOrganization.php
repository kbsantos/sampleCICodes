<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

final class CustomerOrganization implements IEntity
{
    public $id;
    public $customer_id;
    public $title;
    public $description;
    public $address_location;
    public $address;
    public $email;
    public $landline;
    public $mobile;

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
        return 'Customer_Organization';
    }
}