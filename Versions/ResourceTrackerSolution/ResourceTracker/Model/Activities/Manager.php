<?php
namespace ResourceTrackerSolution\ResourceTracker\Model\Activities;


use ValueObjects\Person\Name;

final class Manager
{
    protected $id;
    protected $name;
    protected $email;

    public function __construct($id, Name $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }
}