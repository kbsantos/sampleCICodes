<?php
namespace ResourceTrackerSolution\ResourceTracker\Model\Activities;


final class Attachment
{
    protected $activity_id;
    protected $description;
    protected $source;
    protected $source_id;
    protected $type;

    public function __construct($source_id, $source, $description, $type)
    {
        $this->source_id = $source_id;
        $this->source = $source;
        $this->description = $description;
        $this->type = $type;
    }

    public function getSource()
    {
        return $this->type;
    }

    public function getSourceId()
    {
        return $this->source_id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getType()
    {
        return $this->type;
    }
}