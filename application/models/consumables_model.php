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
          'price_unit'			=> str_replace(',', '.', $this->input->post('price_unit')),
          'currency'			=> $this->input->post('currency'),
          'comment'				=> $this->input->post('comment')
        );
        return $this->db->insert('c_consumables', $new_consumable);
    }
	
	public function update() {
		get_timezone();
        $data = array(
          'vendor' 				=> $this->input->post('vendor'),
          'catalog_number' 		=> $this->input->post('catalog_number'),
          'CAS_description' 	=> $this->input->post('CAS_description'),
          'category' 			=> $this->input->post('category'),			
          'package_size' 		=> $this->input->post('package_size'),
          'price_unit'			=> str_replace(',', '.', $this->input->post('price_unit')),
          'currency'			=> $this->input->post('currency'),
          'comment'				=> $this->input->post('comment'),
          'date_modified'		=> date('Y-m-d H:i:s')
        );		
		// update
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('c_consumables', $data);			
	}
	
	public function delete($id) {
		$this->db->where('id', $id);
		return $this->db->delete('c_consumables');
	}
	
	public function search($limit, $offset, $by, $order, $filter = FALSE){
		// error correction
        $order = ($order == 'desc') ? 'desc' : 'asc';
        $by = (in_array($by, $this->fields)) ? $by : 'CAS_description';
		
        // query
        $this->db->start_cache();
        $query =  $this->db->select(implode(",", $this->fields))
                  ->from('c_consumables')
                  ->order_by($by, $order);
				  
		// filter query ?
        if ( $filter ) {
	        foreach ($filter as $field => $value) {
				if( in_array($field, $this->fields) ) {
					$query->like($field,$value);
				}	            
	        }       	
        }				  
		$this->db->stop_cache();
		
		// count
		$result['count'] = $this->db->count_all_results('c_consumables');
		
		if( $limit )
			$query->limit($limit, $offset);
		$result['consumables'] = $query->get();
       
       	$this->db->flush_cache();
        return $result;		
	}
	
	public function get($consumables, $by = 'id', $select = FALSE) {
		// error correction
		if ( $consumables == '' ) return false;
		if ( $select == FALSE )	$select = '*';
        $by = (in_array($by, $this->fields)) ? $by : 'id';
		
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
	
	public function get_all($field = 'id'){
		// error correction
		$field = (in_array($field, $this->fields)) ? $field : 'id';
		$this->db->select($field);
		return $this->db->get('c_consumables');
	}
}