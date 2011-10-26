<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access_control {

    public function hasPermission() {
      
      // if there exist no policy grant permission
      if ( !isset($acl[$controller][$method]) )
        return true;
      
      // else: has to be logged in and has a role 
      if (  !$_SESSION['logged_in'] || !$_SESSION['role'] )
        return false;
      
      // else: check if has permission
      if( $acl[$_SESSION['role']][$controller][$method] === TRUE )
        return true;
      
      return false;
    }

}

/* End of file Access_control.php */