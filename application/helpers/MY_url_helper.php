<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!function_exists('table_action')) {
	function table_action($type, $uri, $username) {
		// addtitional data
		$data = array('name' => $type . '-' . $username, 'class' => 'action ' . $type, 'value' => $type, 'type' => 'submit');
		$hidden = array('users' => array($username));

		if ($type == 'edit')
			$uri .= '/' . $username . '/';

		// create action HTML
		$output = form_open($uri, '', $hidden);
		$output .= form_input($data);
		$output .= form_close();

		return $output;
	}

}

if (!function_exists('create_alert_message')) {
	function create_alert_message($type, $msg_header, $msg_body) {
		// error correction
		$types = array('warning', 'error', 'success', 'info');
		$type = (in_array($type, $types)) ? $type : 'error';

		$output = '<div class="alert alert-' . $type . ' fade in"><a class="close" href="#" data-dismiss="alert">×</a>';
		$output .= '<strong>' . $msg_header . '</strong> ' . $msg_body;
		$output .= '</div>';

		return $output;
	}

}

if (!function_exists('create_query_string')) {
	function create_query_string($query, $part) {
		if (is_array($part))
			return $part.'='.implode('+',$query[$part]);
		return $part.'='.str_replace(' ', '+', $query);
	}
}

if (!function_exists('print_a')) {
	function print_a() {
		$numargs = func_num_args();
		if ($numargs > 1) {
			$out = '';
			ob_start();
			echo "<div style='background-color:#FFCC33;border:1px solid black;margin:3px;padding:5px;'>";
			for ($a = 0; $a < $numargs; $a++)
				print_a(func_get_arg($a));
			echo "</div>";
			$out .= ob_get_contents();
			ob_end_clean();
			echo $out;
		} else {
			echo "<pre style='background-color:#FFDF80;border:1px solid #000;margin:3px;padding:5px;'>";
			$a = func_get_arg(0);
			$a = (is_bool($a)) ? (($a) ? 'true' : 'false') : $a;
			print_r($a);
			echo "</pre>";
		}
	}

}
/* End of file MY_url_helper.php */
/* Location: ./applicatuion/helpers/MY_url_helper.php */
