<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Admin extends MY_Controller {

    public function index() {
        $data['main_content'] = 'admin/index';
        $this->load->view('layout/template', $data);    
    }

    public function users() {
        $this->db->select('username, first_name, last_name, email, role');
        $this->load->library('table');
        $query = $this->db->get('users');

        $tmpl = array ( 'table_open'  => '<table class="bordered-table zebra-striped">' );
        $this->table->set_template($tmpl); 
        $this->table->set_heading(array('Username', 'First Name', 'Last Name', 'Email', 'Role'));
        $data['table'] = $this->table->generate($query);
        
        $data['main_content'] = 'admin/users';
        $this->load->view('layout/template', $data);         
    }
    
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */