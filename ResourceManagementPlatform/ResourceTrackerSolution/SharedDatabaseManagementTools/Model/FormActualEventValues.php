<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\Model;


use ResourceTrackerSolution\SharedKernel\IEntity;

class FormActualEventValues implements IEntity
{
    public $actual_event_id;
    public $form_field_id;
    public $value;

    public function __toString()
    {
        return 'form_actual_event_values';
    }

    public function getId()
    {
        return;
    }

    public function setId($id)
    {
    }

}
