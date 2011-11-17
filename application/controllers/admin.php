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
        $data['table_users'] = FALSE;
		if ( $query['count'] > 0 ) {
	        $this->load->library('table');
	        $this->table->set_heading(array('Username', 'Email', 'Role'));
	        $data['table_users'] = $this->table->generate($query['users']);        
	        $data['count'] = $query['count'];
		}
	
        $data['main_content'] = 'admin/index';
        $this->load->view('layout/template', $data);    
    }

	public function users_actions(){
		$this->session->set_flashdata('marked', $users = $this->input->post('marked'));
		switch ($_POST['action']) {
			case 'role':
				redirect('admin/users/role');
				break;
			case 'delete':
				redirect('admin/users/delete');
				break;				
			default:
				redirect('admin/users/view');
				break;
		}
	}

    public function users_view($query = 'all', $by = 'username', $order = 'asc', $offset = 0) {   
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
		$data['query'] = $query;
		
		// filter or search?        
		$filter = FALSE;
		if ( $query != 'all' ) {
			$filter['mode'] = 'filter';
			parse_str($query, $filter['terms']);
	
			// mode = search?	
			if( array_key_exists('search', $filter['terms']) ) {
				$filter['mode'] = 'search';
				$filter['terms'] = $filter['terms']['search'];
			}
		}

        // get users
        $this->load->model('user_model');
        $query = $this->user_model->search($limit, $offset, $by, $order, $filter);
        $data['users'] = $query['users']->result();
        $data['count'] = $query['count'];
        
        // pagination config
        $config = array();
        $config['base_url'] = site_url("admin/users/view/$query/$by/$order");
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
	
	public function users_role() {
		$this->load->model('user_model');
		$users = $this->session->flashdata('marked');
		
		// role change confirmed?
		if( $this->input->post('submit-role') ) {
			print_a($_POST);
			print_a($this->session->flashdata('marked'));
			foreach ($_POST['role'] as $user => $role) {
				$data['role'] = $role;
				$this->user_model->update($user, $data);
			}
			$msg = create_alert_message('success', 'Role update successfull!', count($_POST['role']).' users updated.');
			$this->session->set_flashdata('message', $msg);
			redirect('admin/users_view');
		}		

		$data['users'] = $this->user_model->get($users)->result();
        $data['fields'] = array(
                    'username'    => 'Username',
                    'first_name'  => 'First Name',
                    'last_name'   => 'Last Name',
                    'email'       => 'Email',
                    'role'        => 'Role'
        );
		
		$data['main_content'] = 'admin/users_role';
        $this->load->view('layout/template', $data);
	}
	
	public function users_delete($users = FALSE) {
		// single or multiple delete
		if( $users == FALSE ) {
			$users = $this->session->flashdata('marked');
		}
		$this->session->keep_flashdata('marked');
		
		// deletion confirmed?
		if( $this->input->post('submit-delete') ) {
			$this->delete($users, 'User(s)');
			die();
		}
				
		$this->load->model('user_model');
		$query = $this->user_model->get($users);
		
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
	
	public function users_filter(){
		$filter = 'all';
		if( isset($_POST['filter']) )
			$filter = http_build_query( array($_POST['filter']['by'] => $_POST['filter']['term']) );
		redirect('admin/users/view/'.$filter);
	}
	
	public function users_search(){
		$search= 'all';
		if( isset($_POST['search']) )
			$search = http_build_query( array( 'search' => $_POST['search'] ) );
		redirect('admin/users/view/'.$search);
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */