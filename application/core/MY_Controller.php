<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_Controller extends CI_Controller {

    public function __construct() {
      parent::__construct();
      if ( !$this->session->userdata('role') || !$this->session->userdata('logged_in') ) { 
          $data = array(
              'logged_in' => FALSE,
              'role'      => 'visitor'
          );
          $this->session->set_userdata($data);
      }
      if ( !$this->session->hasPermission($this->session->userdata('role'), $this->router->class, $this->router->method) )
        redirect( 'account/permission_denied' );
    } 
    
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */