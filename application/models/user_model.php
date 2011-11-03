<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

require_once('PasswordHash.php');

class User_model extends CI_Model {

    public function create() {
      $hasher = new PasswordHash(8, false);
      $hashedPassword = $hasher->HashPassword($this->input->post('password'));
      if (strlen($hashedPassword) < 20) {
        return false;
      }
    
      // check if username already exists
      $this->db->where('username', $this->input->post('first_name').$this->input->post('last_name'));
      $query = $this->db->get('users');
      if($query->num_rows == 1)
        return false;
    
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
        $hasher = new PasswordHash(8, false);
        $hasher->CheckPassword($this->input->post('password'), $query->row(0)->password);
        if ($hasher)
          return $query->row(0)->role;
      }
      return false;
    }
  
}