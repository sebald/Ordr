<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('table_action'))
{
	function table_action($type, $uri, $username) {
		// addtitional data
		$data = array(
						'name'      => $type.'-'.$username,
						'class'		=> 'action '.$type,
						'value'     => $type,
						'type'		=> 'submit'
		            );
		$hidden = array ( 'users' => array ($username) );
		
		if ( $type == 'edit' )
			$uri .= '/'.$username.'/';
		
		// create action HTML
		$output = form_open($uri,'',$hidden);
		$output .= form_input($data);		
		$output .= form_close();
		
		return $output;
	}
}

if ( ! function_exists('create_alert_message'))
{
	function create_alert_message($type, $msg_header, $msg_body) {
		// error correction
		$types = array('warning', 'error', 'success', 'info');
        $type = (in_array($type, $types)) ? $type : 'error';		
		
		$output  = '<div class="alert-message block-message '.$type.'" data-alert="alert"><a href="#" class="close">×</a>';
		$output .= '<p><strong>'.$msg_header.'</strong> '.$msg_body.'</p>';
		$output .= '</div>';
		
		return $output;
	}
}

/* End of file MY_url_helper.php */
/* Location: ./applicatuion/helpers/MY_url_helper.php */