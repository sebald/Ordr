<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * Admin Controller.
 *
 * @package		Ordr
 * @subpackage	Controller
 * @category	
 * @author		Sebastian Sebald
 */
class Admin extends MY_Controller {

    public function index() {
        $data['fields'] = array(
                    'username'    => 'Username',
                    'email'       => 'Email',
                    'role'        => 'Role'
        );   
		$filter['role'] = 'new';
        $filter['display'] = array('username', 'email', 'role');
    
        // get users
        $this->load->model('user_model');
        $query = $this->user_model->search(5, 0, 'date_created', 'asc', $filter);

        $data['table_users'] = FALSE;
		if ( $query['count'] > 0 ) {       
	        $data['new_users'] = $query['count'];
		}
	
        $data['main_content'] = 'admin/index';
        $this->load->view('layout/template', $data);    
    }


	/********************************************************/
	/*					ADMIN - USERS						*/
	/********************************************************/

	/**
	 * 	Redirecting to the requested action.
	 * 	The redirect is needed because there is only one form action, but there are more than
	 * 	one actions for table data.
	 */
	public function users_actions(){		
		// request search
		if ( $this->input->post('action') == 'search' ) {
			$this->session->set_flashdata('search', $this->input->post('search'));
			redirect('admin/users/search');
		}
		// nothing selected for action => deny request
		if ( $this->input->post('marked') == FALSE ){
	        $msg = create_alert_message('warning', 'No can do!', 'Please select some records and try again.');
			$this->session->set_flashdata('message', $msg);			
			redirect($_SERVER['HTTP_REFERER']);
		}
		// request based on action parameter
		$this->session->set_flashdata('marked', $users = $this->input->post('marked'));
		switch ($this->input->post('action')) {
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

	/**
	 * 	Displaying user data in a table and provide actions to manage users. All parameters are
	 * 	optional.
	 * 	@param 	query	the query string
	 * 	@param	by		field, which should be used to order the data
	 * 	@param	order	asc or desc ordering
	 * 	@param	page	used by the CI pagination
	 */
    public function users_view($query = 'all', $by = 'username', $order = 'asc', $page = 1) {   
        $limit = 15;
        $data['fields'] = array(
                    'username' 		=> 'Username',
                    'first_name' 	=> 'First Name',
                    'last_name' 	=> 'Last Name',
                    'email' 		=> 'Email',
                    'role' 			=> 'Role'
        );
        $data['by'] = $by;
        $data['order'] = $order;
		$data['query'] = $query;
		
		// parse query      
		$filter = FALSE;
		if ( $query != 'all' ) {
			parse_str($query, $filter);
			// display options
			if( isset($filter['display']) ) {
				// seperate display values with commas
				$filter['display'] = explode(' ', $filter['display']);
				// remove unwanted fields from table
				foreach ($data['fields'] as $key => $value) {
					if( !in_array($key, $filter['display']) )
						unset($data['fields'][$key]);
				}
			}
			$data['filter'] = $filter;
		}

        // get users
        $offset = ($page-1)*$limit;
        $this->load->model('user_model');
        $result = $this->user_model->search($limit, $offset, $by, $order, $filter);
        $data['users'] = $result['users']->result();
        $data['count'] = $result['count'];

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
    
	/**
	 * 	Edit a single user.
	 * 	@param	username	username of the user, which should be edited
	 */
	public function users_edit($username) {
		$this->load->model('user_model');
		$data['settings'] = $this->user_model->get($username)->row(0);

		// set and keep referer for cancel button
		if( !$this->session->flashdata('referer') ) {
			$this->session->set_flashdata('referer', $_SERVER['HTTP_REFERER']);
		} else {
			$this->session->keep_flashdata('referer');
		}

		// set form validation
      	$this->load->library('form_validation');
      	$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');

		// validate form
	    if( $this->form_validation->run() == FALSE ) {
	        // form error
	    } else {      
	        // update settings
	        $this->user_model->update($username);
	        $msg = create_alert_message('success', 'Updated completed.', 'The account information has been updated successfully.');
			$this->session->set_flashdata('message', $msg);
			redirect('admin/users/edit/'.$username);
	    }
		
		$this->load->helper('taxonomies');
		$data['user_categories'] = get_user_categories();
		
		$data['main_content'] = 'admin/users_edit';
        $this->load->view('layout/template', $data);
	}
	
	/**
	 * 	Change the role of users. This is one of the table actions.
	 */
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
			redirect('admin/users/view');
		}		

		// get users (by username)
		$data['users'] = $this->user_model->get($users)->result();
        $data['fields'] = array(
                    'username'    => 'Username',
                    'first_name'  => 'First Name',
                    'last_name'   => 'Last Name',
                    'email'       => 'Email',
                    'role'        => 'Role'
        );
		
		$this->load->helper('taxonomies');
		$data['user_categories'] = get_user_categories();
		
		$data['main_content'] = 'admin/users_role';
        $this->load->view('layout/template', $data);
	}
	
	/**
	 * 	Delete user(s). This is one of the table actions, but can also be used for "quick deleting" a single user.
	 */
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
	
	/**
	 * 	Helper function for deleting user(s).
	 */
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
		if( $this->session->flashdata('search') )
			$search = http_build_query( array( 'search' => $this->session->flashdata('search') ) );
		if( isset($_POST['display']) && $search != 'all' )
			$search = 'display='.$_POST['display'].'&'.$search;
		if( isset($_POST['display']) && $search == 'all' )
			$search = 'display='.$_POST['display'];		
		redirect('admin/users/view/'.$search);
	}

	public function users_change_view(){
		$display = '';
		if( isset($_POST['display']) )
			$display = 'display=username+'.implode('+',$_POST['display']);
		if( isset($_POST['role']) )
			$display = $display.'&role='.$_POST['role'];
		if( isset($_POST['search']) )
			$display = $display.'&search='.str_replace(' ', '+', $_POST['search']);	
		redirect('admin/users/view/'.$display);
	}

	/********************************************************/
	/*			  	    ADMIN - CONSUMABLES					*/
	/********************************************************/
	
		/**
	 * 	Displaying common consumables in a table and provide actions to manage them. All parameters are
	 * 	optional.
	 * 	@param 	query	the query string
	 * 	@param	by		field, which should be used to order the data
	 * 	@param	order	asc or desc ordering
	 * 	@param	page	used by the CI pagination
	 */
	public function consumables_view($query = 'all', $by = 'description', $order = 'asc', $page = 1){
		$limit = 15;
        $data['fields'] = array(
                    'CAS_description' 		=> 'CAS / Description',
                    'category' 				=> 'Category',
                    'catalog_number' 		=> 'Catalog Number',
                    'vendor' 				=> 'Vendor',
                    'package_size' 			=> 'Package Size',
                    'price_unit'			=> 'Unit Price',
                    'currency'				=> 'Currency'
        );
        $data['by'] = $by;
        $data['order'] = $order;
		$data['query'] = $query;
		$data['filter'] = '';

		$filter = FALSE;
		if ( $query != 'all' ) {
			parse_str($query, $filter);
			$data['filter'] = $filter;	
		}
			
        // get users
        $offset = ($page-1)*$limit;
        $this->load->model('consumables_model');
        $result = $this->consumables_model->search($limit, $offset, $by, $order, $filter);
        $data['consumables'] = $result['consumables']->result();
        $data['count'] = $result['count'];

        // pagination config
        $config = array();
        $config['base_url'] = site_url("admin/consumables/view/$query/$by/$order");
        $config['total_rows'] = $data['count'];
        $config['per_page'] = $limit;
        $config['uri_segment'] = 7;
        $config['num_links'] = 5;
        
        // pagination
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links(); 		
		
		$this->load->helper('taxonomies');
		$data['consumable_categories'] = get_consumable_categories();
		
		$data['main_content'] = 'admin/consumables_view';
        $this->load->view('layout/template', $data);
	}
	
	public function consumables_new(){
		// field name, error message, validation rules
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('CAS_description', 'CAS / Description', 'trim|required|is_unique[c_consumables.CAS_description]');
	    $this->form_validation->set_rules('category', 'Category', 'trim|required');
	    $this->form_validation->set_rules('catalog_number', 'Catalog Number', 'trim|required');
		$this->form_validation->set_rules('vendor', 'Vendor', 'trim|required');
		$this->form_validation->set_rules('package_size', 'Package Size', 'trim|required');
		$this->form_validation->set_rules('price_unit', 'Unit Price', 'trim|required');
		$this->form_validation->set_rules('comment', 'Comment', 'trim|max_length[140]');

		// load some additionals stuff
		$this->load->helper('taxonomies');
		$data['currencies'] = convert_for_typeahead(get_currencies());
		$data['consumable_categories'] = get_consumable_categories();

	    if( $this->form_validation->run() == FALSE ) {
	        $data['main_content'] = 'admin/consumables_new';
	    } else {		
	        $this->load->model('consumables_model');
	        if($this->consumables_model->create()) {
	        	$msg = create_alert_message('success', 'Consumables added successfully!!', '<em>'.$this->input->post('CAS_description').'</em> added to the databse.');
				$this->session->set_flashdata('message', $msg);
	        	redirect('admin/consumables_view');
	    	} else {
	        	$msg = create_alert_message('error', 'Something went wrong!!', 'The consumables has not been added to the databse.');
				$this->session->set_flashdata('message', $msg);
	        	$data['main_content'] = 'admin/consumables_new';			
	        }
	    }		
        $this->load->view('layout/template', $data);
	}
	
	public function consumables_edit($id = FALSE) {
		if ( $id ) {
			$this->load->model('consumables_model');
			$data['consumable'] = $this->consumables_model->get($id)->row(0);
		} else {
			$data['consumable'] = (object) $this->input->post();
		}
		
		// field name, error message, validation rules
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('category', 'Category', 'trim|required');
	    $this->form_validation->set_rules('catalog_number', 'Catalog Number', 'trim|required');
		$this->form_validation->set_rules('vendor', 'Vendor', 'trim|required');
		$this->form_validation->set_rules('package_size', 'Package Size', 'trim|required');
		$this->form_validation->set_rules('price_unit', 'Unit Price', 'trim|required');
		$this->form_validation->set_rules('comment', 'Comment', 'trim|max_length[140]');		
		
	    if( $this->form_validation->run() == FALSE ) {
	        $data['main_content'] = 'admin/consumables_edit';
	    } else {		
	        $this->load->model('consumables_model');
	        if($this->consumables_model->update()) {
	        	$msg = create_alert_message('success', 'Consumables updated successfully!!', 'The consumable <em>'.$this->input->post('CAS_description').'</em> has been updated.');
				$this->session->set_flashdata('message', $msg);
	        	redirect('admin/consumables/view');
	    	} else {
	        	$msg = create_alert_message('error', 'Something went wrong!!', 'The consumables could not be updated.');
				$this->session->set_flashdata('message', $msg);
	        	redirect('admin/consumables/edit/'.$this->input->post('id'));			
	        }
	    }
        $this->load->view('layout/template', $data);
	}
	
	public function consumables_delete($id) {
		if( $this->input->post('submit-delete') == 'confirm') {
			$this->load->model('consumables_model');
			if ( $this->consumables_model->delete($id) ) {
				$msg = create_alert_message('success', 'Consumable deleted successfull!!', 'The consumable <em>'.$this->input->post('CAS_description').'</em> has been deleted.');
				$this->session->set_flashdata('message', $msg);			
			} else {
				$msg = create_alert_message('error', 'Something went wrong!!', 'The consumable <em>'.$this->input->post('CAS_description').'</em> could not be deleted.');
				$this->session->set_flashdata('message', $msg);
			}
			redirect('admin/consumables/view');
		}
		
		$this->load->model('consumables_model');
		$query = $this->consumables_model->get($id, 'id', 'id, vendor, catalog_number, CAS_description, category, package_size, price_unit, currency');
		$data['CAS_description'] = $query->row(0)->CAS_description;
		
		$this->load->library('table');
		$this->table->set_heading(array('id', 'vendor', 'catalog_number', 'CAS_description', 'category', 
							'package_size', 'price_unit', 'currency'));
        $data['table'] = $this->table->generate($query);
		
		$data['main_content'] = 'admin/consumables_delete';
		$this->load->view('layout/template', $data);
	}
	
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */