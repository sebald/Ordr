<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * Account Controller.
 *
 * @package		Ordr
 * @subpackage	MY_Controller
 * @author		Sebastian Sebald (http://www.distractedbysquirrels.com)
 */
class Account extends MY_Controller {

	/**
	 *	There is no direct link in the system to the index, but if someone
	 * 	requests the url, (s)he will be redirected accordinly. Meaning 
	 * 	registration if not logged in, account settings otherwise.
	 */
    public function index() {
      if ( $this->session->userdata('logged_in') ) {
        redirect('account/settings');
      } else {
        redirect('account/register');
      }
    }

	/**
	 * 	Method to log a user into the system. If credentials are correct the
	 * 	session data will be set and (s)he will be redirected to the 'main'
	 * 	page. In this case the order overview. If the credentials aren't
	 * 	correct (s)he will be redirected to a view, where (s)he can try to
	 * 	log in again.
	 * 	
	 * 	There is no view associated with this method. This is only used as
	 * 	actions by forms.
	 */
    public function login() {		
      $this->load->model('user_model');
	  $query = $this->user_model->validate();   
      if( $query ) {
        $data = array(
          'username'  => $this->input->post('username'),
          'logged_in' => TRUE,
          'role'      => strtolower($query)
        );
        $this->session->set_userdata($data);
        redirect('orders/view');
      } else {        
		$msg = create_alert_message('error', 'Oh snap! You entered the wrong unsername and/or password.', 'Please try it again. If you still can not log in make sure that your account is activated and you haven\'t enabled caps lock on your keyboard. ');
		$this->session->set_flashdata('message', $msg);
		$this->session->set_flashdata('username', $this->input->post('username'));
        redirect('account/login_failed');
      }
    }    
 
 	public function login_failed() {
 		$data['controls'] = FALSE;
 		$data['main_content'] = 'account/login_failed';
 		$this->load->view('layout/template', $data);
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
          $msg = create_alert_message('error', 'Oh snap! There was an problem with displaying your settings.', 'Please try again.');
		  $this->session->set_flashdata('message', $msg);
		  redirect('account/settings');
      } else {      
          // update settings
          $this->user_model->update();
          $msg = create_alert_message('success', 'Update successfully!!', 'Your account information has been updated successfully.');
		  $this->session->set_flashdata('message', $msg);
		  redirect('account/settings');
      }
      $data['main_content'] = 'account/settings'; 
      $this->load->view('layout/template', $data);
    } 
}

/* End of file account.php */
/* Location: ./application/controllers/account.php */