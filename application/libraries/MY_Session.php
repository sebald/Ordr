<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Session extends CI_Session {

    private $acl = array();

    public function __construct() {
        parent::__construct();
        $this->acl = $this->CI->config->item('acl');
    }
    
    public function hasPermission($role, $controller, $method) {
      // if there exist a policy for the controller: grant permission     
      if ( isset($this->acl[$role][$controller]) && (@$this->acl[$role][$controller] === TRUE) )
        return true;

      // if there exist a policy for the controller method: grant permission
      if ( isset($this->acl[$role][$controller][$method]) && (@$this->acl[$role][$controller][$method] === TRUE) )
        return true;        
        
      // else: deny permission
      return false;
    }
    
}

/* End of file MY_Session.php */