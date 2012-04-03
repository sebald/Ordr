<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_currencies')) {
	function get_currencies() {
		return array( 'CHF', 'EUR', 'GBP', 'USD' );	
	}
}

if (!function_exists('get_consumable_categories')) {
	function get_consumable_categories() {
		return array( 'Chemical', 'Equipment', 'Solvent', 'BioLab' );	
	}
}

if (!function_exists('get_user_categories')) {
	function get_user_categories() {
		return array( 'Inactive', 'User', 'Purchaser', 'Admin' );	
	}
}

if (!function_exists('get_work_statuses')) {
	function get_work_statuses() {
		return array( 'open', 'ordered', 'completed' );	
	}
}

if (!function_exists('get_timezone')) {
	function get_timezone() {
		return date_default_timezone_set('Europe/Berlin');;	
	}
}

if (!function_exists('convert_for_typeahead')) {
	function convert_for_typeahead($array) {
		if ( !is_array($array) )
			return 'input has to be an array';
		$output = '[';
		$length = count($array);
		for ($i=0; $i < $length; $i++) { 
			$output .= ' "'.$array[$i].'"';
			if( $i+1 != $length )
				$output .= ',';
		}		
		$output .= ' ]';
		return $output;
	}
}

/* End of file taxonomy_helper.php */