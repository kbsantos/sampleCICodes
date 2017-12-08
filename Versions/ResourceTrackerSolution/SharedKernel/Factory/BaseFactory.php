<?php
namespace ResourceTrackerSolution\SharedKernel\Factory;


/**
 * Class BaseFactory Work In-progress
 * @package ResourceTrackerSolution\SharedKernel\Factory
 */
abstract class BaseFactory {

    private $entity;
    private $dto;

    public abstract function registerMapping();

    public function __construct($entity, $dto){
        $this->entity = $entity;
        $this->dto = $dto;
    }

    public function createDto($entity)
    {
        $mapping = $this->registerMapping()->get();

        $ref_entity = new \ReflectionObject($entity);
        $dto = new \ReflectionObject($this->dto);
        foreach($mapping as $key => $val){
            $eprop = $ref_entity->getProperty($key);
            $eprop->setAccessible(true);
            $prop = $dto->getProperty($val);
            $prop->setAccessible(true);
            $prop->setValue($this->dto, $eprop->getValue($entity));
        }

        return $this->dto;
    }

    public  function createEntity($dto)
    {
        $mapping = $this->registerMapping()->get();

        $entity = new \ReflectionObject($this->entity);
        $ref_dto = new \ReflectionObject($dto);

        foreach ($mapping as $key => $val) {
            $eprop = $entity->getProperty($key);
            $eprop->setAccessible(true);
            $prop = $ref_dto->getProperty($val);
            $prop->setAccessible(true);
            $eprop->setValue($this->entity, $prop->getValue($dto));
        }

        return $this->entity;
    }
}