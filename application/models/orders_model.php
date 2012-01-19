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
					                    'username'				=>	'Ordered by'										
										);
	
	protected $default_order_by = 'date_created';
	
	protected $constraints 		= array(
										'price_unit'			=>	array( 'currency' ),
										'price_total'			=>	array( 'currency' )
										);							
	
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
          'price_total'			=> str_replace(',', '.', $this->input->post('price_unit'))*$this->input->post('quantity'),
          'currency'			=> $this->input->post('currency'),
          'account'				=> $this->input->post('account'),
          'comment'				=> $this->input->post('comment')
        );
        return $this->db->insert('orders', $new_order);	
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
}
	