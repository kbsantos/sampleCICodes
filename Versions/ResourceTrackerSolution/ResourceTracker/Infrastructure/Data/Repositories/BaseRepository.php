<?php
namespace ResourceTrackerSolution\Infrastructure\Repositories;



abstract class BaseRepository
{
    public function add(IEntity $entity){
        
        //$reflect = new \ReflectionObject($entity);
        $reflect = new \ReflectionClass(get_class($entity));
        $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);
        //$props

        $properties = array();
        $values = array();
        if (!empty($props)) {
            foreach ($props as $prop) {
                $properties[] = $prop->getName();
                $proper = $reflect->getProperty($prop->getName());
                $proper->setAccessible(true);
                $values[] = trim((string)$proper->getValue($entity));
            }
        }

        $table = $reflect->getShortName();
        $str_property = implode(',', $properties);
        $str_value = implode("','", $values);

        $sql = "INSERT INTO $table ($str_property) VALUES ('$str_value') ";
        var_dump($sql);
    }
}