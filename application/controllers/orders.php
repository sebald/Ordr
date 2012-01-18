<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Orders extends MY_Controller {

    public function index() {   
      	$data['main_content'] = 'orders/index';
      	$this->load->view('layout/template', $data);		
    }    

	public function new_order() {
		// field name, error message, validation rules
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('CAS_description', 'CAS / Description', 'trim|required|max_length[80]');
	    $this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[30]');
	    $this->form_validation->set_rules('catalog_number', 'Catalog Number', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('vendor', 'Vendor', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('package_size', 'Package Size', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('price_unit', 'Unit Price', 'trim|required|decimal|max_length[10]');
		$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|is_natural_no_zero|max_length[5]');
		$this->form_validation->set_rules('account', 'Account', 'trim|max_length[40]');
		$this->form_validation->set_rules('comment', 'Comment', 'trim|max_length[140]');		
		
		// data for autocomplete of common consumables
		$this->load->model('consumables_model');
		$result = $this->consumables_model->get_all('CAS_description')->result();
		$data['common_consumables'] = array();
		foreach ($result as $row) {
			array_push($data['common_consumables'], $row->CAS_description);
		}
		
		// did a autocomplete happen?
		$data['order'] =  $this->session->flashdata('consumable');
		
		// process the order
	    if( $this->form_validation->run() == FALSE ) {
	        $data['main_content'] = 'orders/new_order';	
	    } else {		
	        $this->load->model('orders_model');
	        if($this->orders_model->create()) {
	        	$msg = create_alert_message('success', 'Order placed successfully!!', 'You will be notified as soon a purchaser has processed your order.');
				$this->session->set_flashdata('message', $msg);
				$data['main_content'] = 'orders/new_order';
	        	//redirect('orders');
	    	} else {
	        	$msg = create_alert_message('error', 'Something went wrong!!', 'The consumables has not been added to the databse.');
				$this->session->set_flashdata('message', $msg);
	        	$data['main_content'] = 'orders/new_order';			
	        }
	    }
      	$this->load->view('layout/template', $data);			
	}
	
	public function autocomplete_order() {
		$this->load->model('consumables_model');
		$result = $this->consumables_model->get($this->input->post('search'), $by = 'CAS_description')->row(0);
		
		$this->session->set_flashdata('consumable', $result);
		redirect('orders/new');
	}

}