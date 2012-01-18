<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Orders_model extends CI_Model {
	
	private $fields = array('id', 'username', 'vendor', 'catalog_number', 'CAS_description', 'category', 
							'package_size', 'price_unit', 'currency', 'comment', 'work_status', 'date_created',
							'date_modified');
	
	public function create() {
        $new_order = array(
          'user_id' 			=> $this->session->userdata('username'),
          'vendor' 				=> $this->input->post('vendor'),
          'catalog_number' 		=> $this->input->post('catalog_number'),
          'CAS_description' 	=> $this->input->post('CAS_description'),
          'category' 			=> $this->input->post('category'),			
          'package_size' 		=> $this->input->post('package_size'),
          'price_unit'			=> str_replace(',', '.', $this->input->post('price_unit')),
          'quantity'			=> $this->input->post('quantity'),
          'currency'			=> $this->input->post('currency'),
          'account'				=> $this->input->post('account'),
          'comment'				=> $this->input->post('comment')
        );
        return $this->db->insert('orders', $new_order);	
	}	
	
}
	