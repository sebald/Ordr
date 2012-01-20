<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()	{
		$data['controls'] = FALSE;
		$data['main_content'] = 'welcome';
		$this->load->view('layout/template', $data);
	}
	
	public function access_denied() {
		$data['controls'] = FALSE;
      	$data['main_content'] = 'layout/access_denied';
      	$this->load->view('layout/template', $data);    	
	}
	
	public function faq() {
		$data['controls'] = FALSE;
		$data['main_content'] = 'faq/faq_all';
    	$this->load->view('layout/template', $data);
	}
		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */