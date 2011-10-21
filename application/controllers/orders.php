<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Orders extends MY_Controller {

    public function index() {   
      $data['main_content'] = 'orders/index';
      $this->load->view('layout/template', $data);		
    }    

}