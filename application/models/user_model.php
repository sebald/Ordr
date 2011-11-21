<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class User_model extends CI_Model {

	private $fields = array('username', 'first_name', 'last_name', 'email', 'role');

    public function create() {
        // check if username already exists
        $this->db->where('username', $this->input->post('first_name').$this->input->post('last_name'));
        $query = $this->db->get('users');
        if($query->num_rows == 1)
          return false;
      
        $this->load->library('encrypt');
        $hashedPassword = $this->encrypt->sha1($this->input->post('password'));
      
        $new_user_data = array(
          'username' 	=> $this->input->post('first_name').$this->input->post('last_name'),
          'first_name' 	=> $this->input->post('first_name'),
          'last_name' 	=> $this->input->post('last_name'),
          'email' 		=> $this->input->post('email'),			
          'password' 	=> $hashedPassword
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
    
    public function get_settings($username = FALSE) {
    	if ( $username == FALSE )
			$username = $this->session->userdata('username');
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if($query->num_rows == 1) {        
          return $query->row(0);
        }
        return false;
    }
    
    public function update($username = FALSE, $data = FALSE) {
    	if ( $username == FALSE )
			$username = $this->session->userdata('username');
		if ( $data == FALSE) {    	
	        $data['email'] = $this->input->post('email');
			if ( $this->input->post('role') )
				$data['role'] = $this->input->post('role');
	        // update pwd?
	        if ( $this->input->post('newpassword') != '') {
	          $hashedPassword = $this->encrypt->sha1($this->input->post('newpassword'));
	          $data['password'] = $hashedPassword;
	        }			
		}
		// update
        $this->db->where('username', $username);
        $this->db->update('users', $data); 
        
    }
    
	/**
	 *	Search users. 
	 *
	 * 	@param filter	Has to be an array.
	 * 					(1) display
	 * 					(2) search
	 * 	
	 */
    public function search($limit, $offset, $by, $order, $filter = FALSE) {
        // error correction
        $order = ($order == 'desc') ? 'desc' : 'asc';
        $by = (in_array($by, $this->fields)) ? $by : 'username';
		
		// field selection
		if( array_key_exists('display', $filter) ) {
			// remove unknown fields from display filter
			foreach ($filter['display'] as $i => $field) {
				if( !in_array($field, $this->fields) ) {
					unset($filter['display'][$i]);
				}
			}
			$select = implode(",", $filter['display']);
		} else {
			$select = implode(",", $this->fields);
		}
	
        // query
        $this->db->start_cache();
        $query =  $this->db->select($select)
                  ->from('users')
                  ->order_by($by, $order);
		
		// search query?
		if ( isset($filter['search']) ) {
			$query->where('MATCH ('.$select.') AGAINST (\''.$filter['search'].'\' IN BOOLEAN MODE)', NULL, FALSE);
		}
				  
        // filter query ?
        if ( $filter ) {
	        foreach ($filter as $field => $value) {
				if( in_array($field, $this->fields) ) {
					$query->like($field,$value);
				}	            
	        }       	
        }
		$this->db->stop_cache();
		
		// count
		$result['count'] = $this->db->count_all_results('users');
		
		$query->limit($limit, $offset);
		$result['users'] = $query->get();
       
       	$this->db->flush_cache();
        return $result;
    }
	
	public function get($users, $by = 'username', $select = 'username, first_name, last_name, email, role'){
		// no users given?
		if ($users == '') return false;
		
		// error correction
		$fields = array('username', 'first_name', 'last_name', 'email', 'role');
        $by = (in_array($by, $fields)) ? $by : 'username';
		
		// selected fields
		$this->db->select($select);
		
		// get multiple users?
		if( is_array($users)){
			$this->db->where_in($by, $users);
		} else {
			$this->db->where($by, $users);
		}
		return $this->db->get('users');
		
	}
	
	public function delete($users, $by = 'username'){
		// get multiple users?
		if( is_array($users)){
			$this->db->where_in($by, $users);
		} else {
			$this->db->where($by, $users);
		}
		return $this->db->delete('users');		
	}
}