<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Account extends CI_Controller {

    public function index() {
      $data['main_content'] = 'account/register_form';
      $this->load->view('layout/template', $data);		
    }

    public function sign_in()
    {		
      $this->load->model('user_model');
      $query = $this->user_model->validate();
      
      if($query) {
        $data = array(
          'username' => $this->input->post('username'),
          'is_logged_in' => true
        );
        $this->session->set_userdata($data);
        redirect('/');
      } else {
        $this->index();
      }
    }    
 
	function sign_out() {
		$this->session->sess_destroy();
		$this->index();
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
        $this->load->view('account/register_form');
      } else {		
        $this->load->model('user_model');
        if($query = $this->user_model->create()) {
          $this->load->view('account/register_successful');
        } else {
          $this->load->view('account/register_form');			
        }
      }
      
    }

}