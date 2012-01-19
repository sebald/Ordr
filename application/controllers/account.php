<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Account extends MY_Controller {

    public function index() {
      if ( $this->session->userdata('logged_in') ) {
        redirect('account/settings');
      } else {
        redirect('account/register');
      }
    }

    public function login() {
      $this->load->model('user_model');
      $query = $this->user_model->validate();      
      if($query) {
        $data = array(
          'username'  => $this->input->post('username'),
          'logged_in' => TRUE,
          'role'      => strtolower($query)
        );
        $this->session->set_userdata($data);
        // is there a redirect to handle?
        if( !isset($_POST['redirect']) ) {
          redirect('orders/');
          return;
        }
        // check to make sure we aren't redirecting to the login page
        if( $_POST['redirect'] === current_url() ) {
          redirect('orders/');
          return;
        }
        redirect($_POST['redirect']);
      } else {
        $data['main_content'] = 'account/login_form';
        $data['error'] = TRUE;
        $this->load->view('layout/template', $data);
      }
    }    
 
    public function logout() {
      $this->session->sess_destroy();
      redirect(base_url());
    }
 
  	public function register() {
      // field name, error message, validation rules
      $this->load->library('form_validation');
      $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha');
      $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha');
      $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
      $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
      
      
      if( $this->form_validation->run() == FALSE ) {
        $data['main_content'] = 'account/register_form';
      } else {		
        $this->load->model('user_model');
        if($this->user_model->create()) {
          $data['username'] = $this->input->post('first_name').$this->input->post('last_name');
          $data['controls'] = FALSE;
          $data['main_content'] = 'account/register_successful';
        } else {
          $msg = create_alert_message('warning', 'Sorry! The user you want to create already exists.', 'Please contact an admin. Maybe (s)he has already created an user for you.');
		  $this->session->set_flashdata('message', $msg);
          $data['main_content'] = 'account/register_form';			
        }
      }
      $this->load->view('layout/template', $data);
    }

    public function permission_denied() {
      $data['main_content'] = 'account/login_form';
      $data['permission_denied'] = TRUE;
      $this->load->view('layout/template', $data);    
    }
    
    public function settings() {
      // load settings
      $this->load->model('user_model');
      $settings = $this->user_model->get_settings(); 
      if ( $settings ) 
        $data['settings'] = $settings;
      else
        $data['error'] = TRUE;      
    
      // set form validation
      $this->load->library('form_validation');
      $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
      $this->form_validation->set_rules('newpassword', 'Password', 'trim|min_length[4]|max_length[32]');
      $this->form_validation->set_rules('newpassword2', 'Password Confirmation', 'trim|matches[newpassword]');        
      
      if( $this->form_validation->run() == FALSE ) {
          // form error
      } elseif ( !$this->user_model->validate($this->session->userdata('username'),$this->input->post('confirmation') ) ) {
          // confirmation error
          $data['confirmation_error'] = TRUE;
      } else {      
          // update settings
          $this->user_model->update();
          $data['settings_updated'] = TRUE;
      }
      $data['main_content'] = 'account/settings'; 
      $this->load->view('layout/template', $data);
    } 
}

/* End of file account.php */
/* Location: ./application/controllers/account.php */