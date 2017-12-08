<?php
namespace ResourceTrackerSolution\ResourceTracker\Model\Activities;


use ValueObjects\Identity\UUID;

final class ActivityId
{
    private $value;

    public function __construct($id = null)
    {
        $this->value = ($id instanceof UUID) ? $id->toNative() :$id ;
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}
