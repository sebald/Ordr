<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_Controller extends CI_Controller {

    function __construct()
    {
      parent::__construct();
      if ( !$this->session->userdata('logged_in') ) { 
        redirect('account/no_access');
      }
    }
}

/* End of file MY_Controller.php */
/* Location: ./system/MY_Controller.php */