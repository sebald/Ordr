<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$acl = array (
        'admin' => array (
                'account' => TRUE,
                'admin'   => TRUE,
                'orders'  => TRUE,
                'welcome' => TRUE
            ),
         'user' => array (
                'account' => TRUE,
                'orders'  => TRUE,
                'welcome' => TRUE
            ),
         'visitor' => array (
                'account' => array (
                    'index'     => TRUE,
                    'register'  => TRUE,
                    'login'     => TRUE,
                    'logout'    => TRUE
                ),
                'welcome' => TRUE
            ),            
        );

/* End of file acl.php */