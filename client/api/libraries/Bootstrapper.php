<?php


class Bootstrapper
{
    public function __construct()
    {
        $autoload = require APPPATH.'../../ResourceManagementPlatform/vendor/autoload.php';
        $autoload->add('ResourceTrackerSolution',APPPATH.'../../ResourceManagementPlatform');
        $autoload->add('ValueObjects',APPPATH.'../../ResourceManagementPlatform/ResourceTrackerSolution/SharedKernel');
        // load libraries without top-level namespace name.
//        require 'REST_Controller.php';
    }
}