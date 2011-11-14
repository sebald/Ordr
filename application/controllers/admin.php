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

    public function users_view($filter = 'all', $by = 'username', $order = 'asc', $offset = 0) {   
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
		$data['filter'] = $filter;        
        
		$where = FALSE;
		if ( $filter != 'all' )
			parse_str($filter, $where);

        // get users
        $this->load->model('user_model');
        $query = $this->user_model->search($limit, $offset, $by, $order, $where);
        $data['users'] = $query['users']->result();
        $data['count'] = $query['count'];
        
        // pagination config
        $config = array();
        $config['base_url'] = site_url("admin/users/view/$filter/$by/$order");
        $config['total_rows'] = $data['count'];
        $config['per_page'] = $limit;
        $config['uri_segment'] = 7;
        $config['num_links'] = 5;
        
        // pagination
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();        
		
        $data['main_content'] = 'admin/users_view';
        $this->load->view('layout/template', $data);
    }
    
	public function users_edit($username) {
		$this->load->model('user_model');
		$data['settings'] = $this->user_model->get($username)->row(0);

		// set referer
		if( !$this->session->flashdata('referer') ) {
			$this->session->set_flashdata('referer', $_SERVER['HTTP_REFERER']);
		} else {
			$this->session->keep_flashdata('referer');
		}

		// set form validation
      	$this->load->library('form_validation');
      	$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');

	    if( $this->form_validation->run() == FALSE ) {
	        // form error
	    } else {      
	        // update settings
	        $this->user_model->update($username);
	        $msg = create_alert_message('success', 'Updated completed.', 'The account information has been updated successfully.');
			$this->session->set_flashdata('message', $msg);
			redirect('admin/users_edit/'.$username);
	    }
		$data['main_content'] = 'admin/users_edit';
        $this->load->view('layout/template', $data);
	}
	
	public function users_delete() {
		// deletion confirmed?
		if( $this->input->post('submit-delete') ) {
			$this->delete($this->input->post('users'), 'Users');
			die();
		}
				
		$this->load->model('user_model');
		$query = $this->user_model->get($this->input->post('users'));
		
		$this->load->library('table');
		$this->table->set_heading(array('Username', 'First Name', 'Last Name', 'Email', 'Role'));
        $data['table_users'] = $this->table->generate($query); 
		
		$data['main_content'] = 'admin/users_delete';
        $this->load->view('layout/template', $data);
	}
	
	private function delete($data, $type){
		$this->load->model('user_model');
		$this->user_model->delete($data);
		
		$msg = create_alert_message('success', 'Deletion successfull!', count($data).' '.$type.' permantly deleted.');
		$this->session->set_flashdata('message', $msg);
		redirect('admin/users_view');	
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */