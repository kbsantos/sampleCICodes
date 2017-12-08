<?php
namespace ResourceTrackerSolution\ResourceTracker\Model\Activities;


use ValueObjects\Geography\Address;
use ValueObjects\Person\Gender;
use ValueObjects\Web\EmailAddress;

final class Customer
{
    protected $id;
    protected $name;
    protected $address;
    protected $email;
    protected $telephone_number;
    protected $mobile_number;
    protected $gender;
    protected $status;

    public function __construct($name, Address $address, EmailAddress $email, $telephone_number, $mobile_number, Gender $gender, $status)
    {
        $this->name = $name;
        $this->address = $address;
        $this->email = $email->toNative();
        $this->telephone_number = $telephone_number;
        $this->mobile_number = $mobile_number;
        $this->gender = $gender->toNative();
        $this->status = $status;
    }
}