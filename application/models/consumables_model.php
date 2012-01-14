<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Consumables_model extends CI_Model {

	private $fields = array('id', 'vendor', 'catalog_number', 'CAS_description', 'category', 
							'package_size', 'price_unit', 'currency', 'comment', 'date_created',
							'date_modified');
							
	public function create() {      
        $new_consumable = array(
          'vendor' 				=> $this->input->post('vendor'),
          'catalog_number' 		=> $this->input->post('catalog_number'),
          'CAS_description' 	=> $this->input->post('CAS_description'),
          'category' 			=> $this->input->post('category'),			
          'package_size' 		=> $this->input->post('package_size'),
          'price_unit'			=> $this->input->post('price_unit'),
          'currency'			=> $this->input->post('currency'),
          'comment'				=> $this->input->post('comment')
        );
        $insert = $this->db->insert('c_consumables', $new_consumable);
        return $insert;
    }
	
	public function update() {
        $data = array(
          'vendor' 				=> $this->input->post('vendor'),
          'catalog_number' 		=> $this->input->post('catalog_number'),
          'CAS_description' 	=> $this->input->post('CAS_description'),
          'category' 			=> $this->input->post('category'),			
          'package_size' 		=> $this->input->post('package_size'),
          'price_unit'			=> $this->input->post('price_unit'),
          'currency'			=> $this->input->post('currency'),
          'comment'				=> $this->input->post('comment'),
          'date_modified'		=> date('Y-m-d H:i:s')
        );		
		// update
        $this->db->where('CAS_description', $this->input->post('CAS_description'));
        $this->db->update('c_consumables', $data);			
	}
	
	public function delete($CAS_description) {
		$this->db->where('CAS_description', $this->input->post('CAS_description'));
		return $this->db->delete('c_consumables');
	}
	
	public function get($consumables, $by = 'CAS_description', $select = FALSE) {
		// error correction	
		if ( $consumables = '' ) return false;
		if ( $select == FALSE )	$select = $fields;
        $by = (in_array($by, $fields)) ? $by : 'CAS_description';
		
		// selected fields
		$this->db->select($select);
		
		// get multiple consumables?
		if( is_array($consumables) ){
			$this->db->where_in($by, $consumables);
		} else {
			$this->db->where($by, $consumables);
		}
		return $this->db->get('c_consumables');		
	}
}