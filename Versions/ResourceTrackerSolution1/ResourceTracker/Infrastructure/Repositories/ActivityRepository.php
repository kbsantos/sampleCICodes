<?php
namespace ResourceTrackerSolution\ResourceTracker\Infrastructure\Repositories;

use ResourceTrackerSolution\ResourceTracker\Model\Activities\Activity;
use ResourceTrackerSolution\ResourceTracker\Model\Activities\ActivityId;
use ResourceTrackerSolution\ResourceTracker\Model\Activities\IActivityRepository;
use ResourceTrackerSolution\ResourceTracker\Model\Activities\User;
use ValueObjects\Person\Name;
use ValueObjects\StringLiteral\StringLiteral;

class ActivityRepository implements IActivityRepository
{
    public function add(Activity $entity)
    {
        //$reflect = new \ReflectionObject($entity);
//        $reflect = new \ReflectionClass(get_class($entity));
//        $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);
//        //$props
//
//        $properties = array();
//        $values = array();
//        if (!empty($props)) {
//            foreach ($props as $prop) {
//
//                $properties[] = $prop->getName();
//                $proper = $reflect->getProperty($prop->getName());
//                $proper->setAccessible(true);
//                $values[] = trim((string)$proper->getValue($entity));
//            }
//        }
//        $table = $reflect->getShortName();
//        $str_property = implode(',', $properties);
//        $str_value = implode("','", $values);
//
//        $sql = "INSERT INTO $table ($str_property) VALUES ('$str_value') ";
//        var_dump($sql);
    }

    public function find(ActivityId $activityId)
    {
        // TODO: Implement find() method.
    }

    public function fetch()
    {
        // TODO: Implement fetch() method.
    }

    public function update(Activity $activity)
    {
        // TODO: Implement update() method.
    }

    public function remove(ActivityId $activityId)
    {
        // TODO: Implement remove() method.
    }

    public function fetchUserById($id)
    {
        $name = new StringLiteral('Name');
        return new User($id, new Name($name,$name,$name), array());
    }

}