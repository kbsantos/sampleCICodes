<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;


require_once BASEPATH . '/core/Model.php';

abstract class DbContext extends \CI_Model
{
    public function __construct()
    {

    }

    public function database()
    {
        return $this->db;
    }
}