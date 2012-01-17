<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Orders extends MY_Controller {

    public function index() {   
      	$data['main_content'] = 'orders/index';
      	$this->load->view('layout/template', $data);		
    }    

	public function new_order() {
		// data for autocomplete of common consumables
		$this->load->model('consumables_model');
		$result = $this->consumables_model->get_all('CAS_description')->result();
		$data['common_consumables'] = array();
		foreach ($result as $row) {
			array_push($data['common_consumables'], $row->CAS_description);
		}
		
		// did a autocomplete happen?
		$data['order'] =  $this->session->flashdata('consumable');
		
      	$data['main_content'] = 'orders/new_order';
      	$this->load->view('layout/template', $data);			
	}
	
	public function autocomplete_order() {
		$this->load->model('consumables_model');
		$result = $this->consumables_model->get($this->input->post('search'), $by = 'CAS_description')->row(0);
		
		$this->session->set_flashdata('consumable', $result);
		redirect('orders/new');
	}

}