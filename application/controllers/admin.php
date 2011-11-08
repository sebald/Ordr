<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Admin extends MY_Controller {

    public function index() {
        $data['fields'] = array(
                    'username'    => 'Username',
                    'email'       => 'Email',
                    'role'        => 'Role'
        );   
        $filter = array(
          'role' => 'inactive'
        );
        $select = 'username, email, role';
    
        // get users
        $this->load->model('user_model');
        $query = $this->user_model->search(5, 0, 'date_created', 'asc', $filter, $select);
        
        // generate table
        $this->load->library('table');
        $this->table->set_heading(array('Username', 'Email', 'Role'));
        $data['table_users'] = $this->table->generate($query['users']);        
        $data['count'] = $query['count'];
    
        $data['main_content'] = 'admin/index';
        $this->load->view('layout/template', $data);    
    }

    public function users($by = 'title', $order = 'asc', $offset = 0) {   
        $limit = 10;
        $data['fields'] = array(
                    'username'    => 'Username',
                    'first_name'  => 'First Name',
                    'last_name'   => 'Last Name',
                    'email'       => 'Email',
                    'role'        => 'Role'
        );
        $data['by'] = $by;
        $data['order'] = $order;        
    
        // get users
        $this->load->model('user_model');
        $query = $this->user_model->search($limit, $offset, $by, $order);
        $data['users'] = $query['users']->result();
        $data['count'] = $query['count'];
        
        // pagination config
        $config = array();
        $config['base_url'] = site_url("admin/users/$by/$order");
        $config['total_rows'] = $data['count'];
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['num_links'] = 5;
        
        // pagination layout
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        // pagination
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();        
        
        $data['page'] = FALSE;
        if ($this->pagination->cur_page == 1)
          $data['page'] = 'no-prev';
        if ($this->pagination->cur_page >= ceil($this->pagination->total_rows / $this->pagination->per_page))
          $data['page'] = 'no-next';
        
        $data['main_content'] = 'admin/users';
        $this->load->view('layout/template', $data);
    }
    
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */