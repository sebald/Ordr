<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Orders_model extends MY_Model {
		
	protected $table 			= 'orders';
	
	protected $fields 			= array('id', 'username', 'vendor', 'catalog_number', 'CAS_description', 'category', 
										'package_size', 'price_unit', 'quantity', 'price_total', 'currency', 'comment', 'work_status', 'date_created',
										'date_modified', 'date_ordered', 'date_completed'
										);
	protected $field_names		= array(
					        			'date_created'			=> 	'Date created',
					                    'CAS_description' 		=> 	'CAS / Description',
					                    'price_unit'			=>	'Unit Price',
					                    'price_total'			=>	'Total',
					                    'work_status'			=>	'Status',
					                    'username'				=>	'Placed by'										
										);
	
	protected $default_order_by = 'date_created';
	
	protected $constraints 		= array(
										'price_unit'			=>	array( 'currency' ),
										'price_total'			=>	array( 'currency' )
										);
	protected $select_always	= 'username';																	
	
	public function create() {
        $new_order = array(
          'username' 			=> $this->session->userdata('username'),
          'vendor' 				=> $this->input->post('vendor'),
          'catalog_number' 		=> $this->input->post('catalog_number'),
          'CAS_description' 	=> $this->input->post('CAS_description'),
          'category' 			=> $this->input->post('category'),			
          'package_size' 		=> $this->input->post('package_size'),
          'price_unit'			=> str_replace(',', '.', $this->input->post('price_unit')),
          'quantity'			=> $this->input->post('quantity'),
          'price_total'			=> str_replace(',', '.', $this->input->post('price_unit'))*$this->input->post('quantity'),
          'currency'			=> $this->input->post('currency'),
          'account'				=> $this->input->post('account'),
          'comment'				=> $this->input->post('comment')
        );
        return $this->db->insert($this->table, $new_order);	
	}	

	/**
	 *	Order search, filter and display options. 
	 *
	 * 	@param 		filter	Has to be an array. The array fields are:
	 * 						(1) display	- which data base fields are selected
	 * 						(2) search	- match against search in SQL
	 * 						(3) like	- which data base fields has to be like XY
	 * 
	 *  @return 	result	Array with three fields:
	 * 						[data]		- query data result (with limit + offset)
	 * 						[count]		- query data count
	 * 						[filter]	- parsed filters (see parse_query function)
	 * 						[order]		- asc or desc
	 * 						[by]		- field name by which the data is ordered 
	 */
    public function query($limit, $offset, $by, $order, $query = FALSE) {
  		return parent::query($limit, $offset, $by, $order, $query);
    }
	
	public function get($orders, $by = 'id', $select = FALSE) {
		// error correction
		if ( $orders == '' ) return false;
		if ( $select == FALSE )	$select = '*';
        $by = (in_array($by, $this->fields)) ? $by : 'id';
		
		// selected fields
		$this->db->select($select);
		
		// get multiple order?
		if( is_array($orders) ){
			$this->db->where_in($by, $orders);
		} else {
			$this->db->where($by, $orders);
		}
		return $this->db->get($this->table);		
	}
	
	public function update($id = FALSE, $data = FALSE) {
		if( $id == FALSE )
			$id = $this->input->post('id');
		if( $data == FALSE ){
	        $data = array(
	          'username' 			=> $this->session->userdata('username'),
	          'vendor' 				=> $this->input->post('vendor'),
	          'catalog_number' 		=> $this->input->post('catalog_number'),
	          'CAS_description' 	=> $this->input->post('CAS_description'),
	          'category' 			=> $this->input->post('category'),			
	          'package_size' 		=> $this->input->post('package_size'),
	          'price_unit'			=> str_replace(',', '.', $this->input->post('price_unit')),
	          'quantity'			=> $this->input->post('quantity'),
	          'price_total'			=> str_replace(',', '.', $this->input->post('price_unit'))*$this->input->post('quantity'),
	          'currency'			=> $this->input->post('currency'),
	          'account'				=> $this->input->post('account'),
	          'comment'				=> $this->input->post('comment'),
	          'work_status'			=> $this->input->post('work_status'),
	          'date_modified'		=> date('Y-m-d H:i:s')
	        );			
		}
		
		// maybe a status update => set dates
		if( isset($data['work_status'])) {
			// get latest status to check if something has changed
			$latest_status = $this->get($id, 'id', 'work_status')->row(0)->work_status;
			
			// set date_ordered/date_completed
			if( $latest_status != $data['work_status'] ) {
				switch ($data['work_status']) {
					case 'ordered':
						$data['date_ordered'] = date('Y-m-d H:i:s');
						break;
					case 'completed':
						$data['date_completed'] = date('Y-m-d H:i:s');
						break;				
					default:
						// woops!!!
						break;
				}
			}			
		}
		
		// update
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);			
	}
	
	public function delete($ids) {
		// delete multiple orders?
		if( is_array($ids) ) {
			$this->db->where_in('id', $ids);
		} else {
			$this->db->where('id', $ids);
		}
		return $this->db->delete($this->table);
	}
		
}
	