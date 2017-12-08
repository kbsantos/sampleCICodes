<?php
namespace ResourceTrackerSolution\ResourceTracker\Model\Activities;


interface IActivityRepository
{
    public function find(ActivityId $activityId);
    public function fetch();
    public function add(Activity $activity);
    public function update(Activity $activity);
    public function remove(ActivityId $activityId);
}
