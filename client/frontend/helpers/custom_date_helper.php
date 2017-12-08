<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('sys_date_format'))
{
    function sys_date_format($sDate){
		$sRetDate = '-';
		if(trim($sDate)<>''){
			if(strpos($sDate,'00-') == false){
				$sRetDate = mdate('%m/%d/%Y',mysql_to_unix($sDate));	
			}
		}
		return $sRetDate;
	} 
}

if ( ! function_exists('mysql_date_format'))
{
    function mysql_date_format($sDate){
		$sRetDate = NULL;
		if(trim($sDate)<>''){
			if(strpos($sDate,'00-') == false){
				
				$sRetDate = date ("Y-m-d H:i:s", $sDate);
				}
		}
		return $sRetDate;
	} 
}