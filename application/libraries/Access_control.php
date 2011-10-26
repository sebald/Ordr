<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access_control {

    public function hasPermission() {
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

/* End of file Access_control.php */