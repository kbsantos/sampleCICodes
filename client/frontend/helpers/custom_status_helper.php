<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('status_icon'))
{
    function status_icon($sStatus){
		switch($sStatus){
			case 'done':
				$sRetIcon = 'fa-check text-success';
				break;
			case 'info':
				$sRetIcon = 'fa-info text-default';
				break;
			case 'pending':
				$sRetIcon = 'fa-clock-o text-danger';
				break;
			case 'skipped':
				$sRetIcon = 'fa fa-fast-forward text-warning';
				break;
			case 'open':
				$sRetIcon = 'fa fa-fast-backward text-success';
				break;
				
				//fa-folder-open-o
			default : 
				$sRetIcon = '';
		}
		return $sRetIcon;
	} 
}

