<?php

namespace ResourceTrackerSolution\SharedKernel\Factory;


final class Mapping
{
    private $mapping = array();

    public function add($propertyLeft, $propertyRight)
    {
        $this->mapping[$propertyLeft] = $propertyRight;
        return $this;
    }

    public function locateLeft($propertyRight)
    {
        return array_search($propertyRight, $this->mapping);
    }

    public function locateRight($propertyLeft)
    {
        return isset($this->mapping[$propertyLeft])? $this->mapping[$propertyLeft] : null;
    }

    public function get()
    {
        return $this->mapping;
    }
}