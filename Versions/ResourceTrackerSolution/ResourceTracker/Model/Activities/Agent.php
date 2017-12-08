<?php
namespace ResourceTrackerSolution\ResourceTracker\Model\Activities;


use ValueObjects\Person\Name;

final class Agent
{    public function __construct($id, Name $name)
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
    protected $id;
    protected $name;
    protected $email;


}