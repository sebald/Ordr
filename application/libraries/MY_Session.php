<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Session extends CI_Session {

    private $acl;

    public function __construct() {
        parent::__construct();
        $acl = $this->CI->config->item('acl');
    }
    
    private function hasPermission($role, $controller, $method) {
      // if there exist a policy for the controller: grant permission
      if ( $acl[$role][$controller] === TRUE )
        return true;

      // if there exist a policy for the controller method: grant permission
      if ( $acl[$role][$controller][$method] === TRUE )
        return true;        
        
      // else: doesn't have permission to access controler or method
      return false;
    }
    
}

/* End of file MY_Session.php */