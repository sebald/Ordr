<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_currencies')) {
	function get_currencies() {
		return array( 'CHF', 'EUR', 'GBP', 'USD' );
	}
}

if (!function_exists('get_consumable_categories')) {
	function get_consumable_categories() {
		return array( 'Chemical', 'Disposable', 'Solvent');
	}
}

if (!function_exists('get_user_categories')) {
	function get_user_categories() {
		return array( 'Inactive', 'User', 'Purchaser', 'Admin' );
	}
}

if (!function_exists('get_work_statuses')) {
	function get_work_statuses() {
		return array( 'open', 'approval', 'ordered', 'completed' );
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
			$output .= ' "' . htmlentities($array[$i], ENT_QUOTES, "UTF-8") . '"';
			if( $i+1 != $length )
				$output .= ',';
		}
		$output .= ' ]';
		return $output;
	}
}

/*  Converts an string with an int or a german decimal notation to decimal

    When checking an input form where a decimal value is needed - like the
    unit price field - the validation method 'decimal' will return false if
    the value is an integer or a decimal value with german notation (','
    instead of '.')
    This function converts an input to a decimal notation.
        integer: by adding '.00'
        german decimal: by replacing ',' with '.'
*/

function to_decimal($str)
{
    if (preg_match('/^[\-+]?[0-9]+$/', $str))
    {
        # this is an integer, convert it to decimal
        return $str . '.00';
    }
    if (preg_match('/^[\-+]?[0-9]+,[0-9]{0,2}$/', $str))
    {
        # it might be a decimal but with a colon as a separator
        # probably an input from a german keyboard layout :-)
        return str_replace(',', '.', $str);
    }
    return $str;
}

/* End of file taxonomy_helper.php */
