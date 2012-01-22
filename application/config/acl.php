<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// role => controller => method

$config['acl'] = array (
                'admin' => array (
                        'account' => TRUE,
                        'admin'   => TRUE,
                        'orders'  => TRUE
                    ),
                'purchaser' => array (
                        'account' => TRUE,
                        'orders'  => TRUE
                    ),                    
                 'user' => array (
                        'account' => TRUE,
                        'orders'  => TRUE
                    ),
                 'visitor' => array (
                        'account' => array (
                            'index'             => TRUE,
                            'register'          => TRUE,
                            'login'             => TRUE,
                            'login_failed'		=> TRUE,
                            'logout'            => TRUE,
                            'permission_denied' => TRUE
                        )
                    )            
        );

/* End of file acl.php */