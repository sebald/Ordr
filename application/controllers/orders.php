<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Orders extends MY_Controller {

	private $allowed_to_change_status = array ('purchaser', 'admin');

    public function index() {   
      	redirect('orders/view');		
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
	        	redirect('orders/view');
	    	} else {
	        	$msg = create_alert_message('error', 'Something went wrong!!', 'The consumables has not been added to the databse.');
				$this->session->set_flashdata('message', $msg);
	        	$data['main_content'] = 'orders/new_order';			
	        }
	    }
      	$this->load->view('layout/template', $data);			
	}
	
	public function view($query = 'all', $by = 'date_created', $order = 'desc', $page = 1) {
		// set defaults
        $limit = 15;
		$offset = ($page-1)*$limit;

		// get orders
        $this->load->model('orders_model');
        $result = $this->orders_model->query($limit, $offset, $by, $order, $query);
		
		// set stuff to pass to the view
        $data['data'] 	= $result['data']->result();
        $data['count'] 	= $result['count'];
		$data['filter'] = $result['filter'];
		$data['order'] 	= $result['order'];
		$data['by'] 	= $result['by'];
		$data['query'] 	= $query;

		$data['allowed_to_change_status'] = $this->allowed_to_change_status;

		// set field name for the view (these fields will be displayed)
		if( isset($result['filter']['display']) ) {
			$data['fields'] = $this->orders_model->get_field_names($result['filter']['display']);
		// default display	
		} else {
	        $data['fields'] = array(
	        			'date_created'			=> 	'Date created',
	                    'CAS_description' 		=> 	'CAS / Description',
	                    'price_total' 			=> 	'Price Total',
	                    'work_status'			=>	'Status',
	                    'username'				=>	'Placed by'
	        );			
		}

        // pagination config
        $config['base_url'] = site_url("orders/view/$query/$by/$order");
        $config['total_rows'] = $data['count'];
        $config['per_page'] = $limit;
        $config['uri_segment'] = 6;
        $config['num_links'] = 5;
		
        // pagination
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links(); 		
				
        $data['main_content'] = 'orders/view';
        $this->load->view('layout/template', $data);						
	}
	
	public function edit($id = FALSE) {		
		// get order
		if ( $this->input->post() ) {
			// use post if some form errors occured
			$data['order'] = (object) $this->input->post();
		} elseif( $id ) {
			$this->load->model('orders_model');
			$data['order'] = $this->orders_model->get($id)->row(0);			
		} else {
	        	$msg = create_alert_message('error', 'No order specified!!', 'You have been redirected to the order overview.');
				$this->session->set_flashdata('message', $msg);
	        	redirect('orders/view');			
		}	

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
		
		// set who can change the work status
		$data['allowed_to_change_status'] = $this->allowed_to_change_status;

	    if( $this->form_validation->run() == FALSE ) {
	        $data['main_content'] = 'orders/edit_order';
	    } else {		
	        $this->load->model('orders_model');
	        if($this->orders_model->update()) {
	        	$msg = create_alert_message('success', 'Order updated successfully!!', 'The Order <em>#'.$this->input->post('id').'</em> has been updated.');
				$this->session->set_flashdata('message', $msg);
	        	redirect('orders/view');
	    	} else {
	        	$msg = create_alert_message('error', 'Something went wrong!!', 'The order could not be updated.');
				$this->session->set_flashdata('message', $msg);
	        	$data['main_content'] = 'orders/edit_order';			
	        }
	    }
        $this->load->view('layout/template', $data);
	}
	
	public function change_view() {
		$display 	= create_query_string($_POST, 'display');
		$like 		= isset($_POST['like']) ? '&'.$_POST['like'] : '';
		$search 	= isset($_POST['search']) ? '&'.$_POST['search'] : '';
		redirect('orders/view/'.$display.$like.$search);
	}
	
	public function autocomplete_order() {
		$this->load->model('consumables_model');
		$result = $this->consumables_model->get($this->input->post('search'), $by = 'CAS_description')->row(0);
		
		$this->session->set_flashdata('consumable', $result);
		redirect('orders/new');
	}

}