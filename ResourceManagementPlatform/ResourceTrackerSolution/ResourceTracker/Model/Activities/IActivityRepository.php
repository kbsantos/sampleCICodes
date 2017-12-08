<?php
namespace ResourceTrackerSolution\ResourceTracker\Model\Activities;


use ResourceTrackerSolution\SharedKernel\IEntity;

interface IActivityRepository
{
    public function find(ActivityId $activityId);
    public function fetch();
    public function add(IEntity $activity);
    public function update(Activity $activity);
    public function remove(ActivityId $activityId);
}
