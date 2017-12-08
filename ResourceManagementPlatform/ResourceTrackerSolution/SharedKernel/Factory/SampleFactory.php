<?php
namespace ResourceTrackerSolution\SharedKernel\Factory;


use ResourceTrackerSolution\ResourceTracker\Model\Activities\Activity;
use ResourceTrackerSolution\ResourceTracker\Model\Activities\ActivityId;

final class SampleFactory extends BaseFactory
{
    public function __construct()
    {
        $entity = new Activity(new ActivityId());
//
        $dto = new \stdClass();
        $dto->status = null;
        $dto->dto_id = null;
        parent::__construct($entitys, $dto);
    }

    public function registerMapping()
    {
        $map = new Mapping();
        $map->add('id', 'dto_id')
            ->add('status', 'status');
        return $map;
    }
}


