<?php
namespace ResourceTrackerSolution\ResourceTracker\Model\Activities;


use ValueObjects\Person\Name;

final class User
{

    protected $id;
    protected $name;
    protected $email;
    private $roles = array();

    public function __construct($id, Name $name, array $roles)
    {
        $this->id = $id;
        $this->name = $name;
        $this->roles = $roles;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getId()
    {
        return $this->id;
    }
}