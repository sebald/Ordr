<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_currencies')) {
	function get_currencies() {
		return array( 'CHF', 'EUR', 'GBP', 'USD' );	
	}
}

if (!function_exists('get_consumable_categories')) {
	function get_consumable_categories() {
		return array( 'Chemical', 'Equipment', 'Solvent' );	
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

/* End of file currency.php */