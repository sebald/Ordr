<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data['main_content'] = 'welcome';
		$data['controls'] = FALSE;
    	$this->load->view('layout/template', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */