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

    public function validate() {    
      $this->db->where('username', $this->input->post('username'));
      $query = $this->db->get('users');   
      
      if($query->num_rows == 1) {
        // is user active?
        if ( $query->row(0)->role == 'inactive' )
          return false;
        
        // is pwd correct?
        $this->load->library('encrypt');
        $hashedPassword = $this->encrypt->sha1($this->input->post('password'));
        if ( $query->row(0)->password == $hashedPassword )
          return $query->row(0)->role;
      }
      return false;
    }

}