<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class User_model extends CI_Model {

    public function create() {
      // check if username already exists
      $this->db->where('username', $this->input->post('first_name').$this->input->post('last_name'));
      $query = $this->db->get('users');
      if($query->num_rows == 1)
        return false;
    
      $this->load->library('encrypt');
      $hashedPassword = $this->encrypt->sha1($this->input->post('password'));
    
      $new_user_data = array(
        'username' => $this->input->post('first_name').$this->input->post('last_name'),
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'email' => $this->input->post('email'),			
        'password' => $hashedPassword
      );
      $insert = $this->db->insert('users', $new_user_data);
      return $insert;
    }

    public function validate($username = FALSE, $pwd = FALSE) {
      if ( $username == FALSE )
        $username = $this->input->post('username');
      if ( $pwd == FALSE )
        $pwd = $this->input->post('password');        
        
      $this->db->where('username', $username);
      $query = $this->db->get('users');   
      
      if($query->num_rows == 1) {
        // is user active?
        if ( $query->row(0)->role == 'inactive' )
          return false;
        
        // is pwd correct?
        $this->load->library('encrypt');
        $hashedPassword = $this->encrypt->sha1($pwd);
        if ( $query->row(0)->password == $hashedPassword )
          return $query->row(0)->role;
      }
      return false;
    }
    
    public function get_settings() {
      $this->db->where('username', $this->session->userdata('username'));
      $query = $this->db->get('users');
      if($query->num_rows == 1) {        
        return $query->row(0);
      }
      return false;
    }
    
    public function update() {
      $data['email'] = $this->input->post('email');
      
      // update pwd?
      if ( $this->input->post('newpassword') != '') {
        $hashedPassword = $this->encrypt->sha1($this->input->post('newpassword'));
        $data['password'] = $hashedPassword;
      }
      
      // update
      $this->db->where('username', $this->session->userdata('username'));
      $this->db->update('users', $data); 
    }
}