<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller {

	public function index()
	{
		$data['controls'] = FALSE;
		$data['main_content'] = 'faq/faq_all';
    	$this->load->view('layout/template', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */