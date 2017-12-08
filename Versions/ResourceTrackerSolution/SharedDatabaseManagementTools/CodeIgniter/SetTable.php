<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;


use ResourceTrackerSolution\SharedKernel\IEntity;

final class SetTable
{
    private $tableName;
    private $dbContext;
    private $entity;

    public function __construct(IEntity $entity, $dbContext)
    {
        $this->entity = $entity;
        $this->tableName = strtolower((string) $entity);
        $this->dbContext = $dbContext;
    }

    public function find($id)
    {
        $result = $this->dbContext
            ->get_where($this->tableName, array('id' => $id))
            ->row();
        if(empty($result)) return;
        return $this->setPublicAndProtectedFields($this->entity, $result);
    }

    public function fetch()
    {
        $this->dbContext->order_by('id', 'desc');
        $result = $this->dbContext->get($this->tableName)->result(get_class($this->entity));

        if (empty($result)) return;
        return $result;
    }

    public function add(IEntity $entity)
    {
        $this->dbContext->insert($this->tableName,
            $this->getPublicAndProtectedFields($entity));
        $entity->setId($this->dbContext->insert_id());
    }

    public function update(IEntity $entity)
    {
        $this->dbContext->where('id', $entity->getId());
        $this->dbContext->update($this->tableName,
            $this->getPublicAndProtectedFields($entity));
    }

    public function remove(IEntity $entity)
    {
        $this->dbContext->where('id', $entity->getId());
        $this->dbContext->delete($this->tableName);
    }

    private function getPublicAndProtectedFields(IEntity $entity)
    {
        $reflect = new \ReflectionClass(get_class($entity));
        $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);
        $properties = array();
        $values = array();
        if (!empty($props)) {
            foreach ($props as $prop) {
                $proper = $reflect->getProperty($prop->getName());
                $proper->setAccessible(true);
                $values[$prop->getName()] = $proper->getValue($entity);
            }
        }
        return $values;
    }

    private function setPublicAndProtectedFields(IEntity $entity, $object)
    {
        $reflect = new \ReflectionObject($entity);
        $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);
        $properties = array();
        $values = array();
        if (!empty($props)) {
            foreach ($props as $prop) {
                $proper = $reflect->getProperty($prop->getName());
                $proper->setAccessible(true);
                $proper->setValue($entity, $object->{$prop->getName()});
            }
        }

        return $entity;
    }

    public function __toString()
    {
        return get_class($this->entity);
    }
}

