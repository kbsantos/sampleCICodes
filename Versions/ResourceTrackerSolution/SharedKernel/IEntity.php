<?php
namespace ResourceTrackerSolution\SharedKernel;



interface IEntity {
    public function getId();
    public function setId($id);
}