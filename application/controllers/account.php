<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Account extends CI_Controller {

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
          'username' => $this->input->post('username'),
          'logged_in' => true
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
      
      
      if($this->form_validation->run() == FALSE) {
        $data['main_content'] = 'account/register_form';
      } else {		
        $this->load->model('user_model');
        if($this->user_model->create()) {
          $data['main_content'] = 'account/register_successful';
        } else {
          $data['main_content'] = 'account/register_form';			
        }
      }
      $this->load->view('layout/template', $data);
    }

    public function no_access() {
      $data['main_content'] = 'account/login_form';
      $data['no_access'] = TRUE;
      $this->load->view('layout/template', $data);    
    }
    
    public function settings() {
      // only accessible if logged in
      if ( !$this->session->userdata('logged_in') ) {
        redirect('account/no_access');
        return;
      }
      $data['main_content'] = 'account/settings';
      $this->load->view('layout/template', $data);
    }
}