<?php
namespace ResourceTrackerSolution\ResourceTracker\Model\Activities;



final class Territory{

    private $id;
    protected $name;

    public function getName()
    {
        return $this->name;
    }

    public function __toString(){
        return (string) $this->name;
    }
}
