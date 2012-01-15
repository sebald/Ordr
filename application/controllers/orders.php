<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Orders extends MY_Controller {

    public function index() {   
      	$data['main_content'] = 'orders/index';
      	$this->load->view('layout/template', $data);		
    }    

	public function new_order() {
		// load some additionals stuff
		$this->load->helper('taxonomies');
		$data['currencies'] = convert_for_typeahead(get_currencies());
		$data['consumable_categories'] = get_consumable_categories();
		
      	$data['main_content'] = 'orders/new_order';
      	$this->load->view('layout/template', $data);			
	}

}