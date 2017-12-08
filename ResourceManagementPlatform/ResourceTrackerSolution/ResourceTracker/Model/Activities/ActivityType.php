<?php
namespace ResourceTrackerSolution\ResourceTracker\Model\Activities;


final class ActivityType
{
    protected $id;
    protected $name;
    protected $territory_id;
    protected $approval;
    private $territory;

    public function __construct($id)
    {
        $this->id = $id;
    }
    public function needsApproval(){
        return $this->approval == 1;
    }

    public function isTerritory(Territory $territory){
        return $this->territory == $territory;
    }

    public function getId(){
        return $this->id;
    }
}