<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_Model extends CI_Model {

    public function __construct() {
      	parent::__construct();
    } 

	protected $table;
	protected $fields;
	protected $default_order_by;
	
	/**
	 *	Extended query with search, filter and display options.
	 * 	Also supports paging and sorting. 
	 *
	 * 	@param 		filter	Has to be an array. The array fields are:
	 * 						(1) display	- which data base fields are selected
	 * 						(2) search	- match against search in SQL
	 * 						(3) like	- which data base fields has to be like XY
	 * 
	 *   @return 	result	Array with three fields:
	 * 						[data]		- query data result (with limit + offset)
	 * 						[count]		- query data count
	 * 						[filter]	- parsed filters (see parse_query function)
	 * 						[order]		- asc or desc
	 * 						[by]		- field name by which the data is ordered 
	 */
    protected function query($limit, $offset, $by, $order, $query = FALSE) {
        // error correction + add to result
        $order = ($order == 'desc') ? 'desc' : 'asc';
		$result['order'] = $order;
        $by = (in_array($by, $this->fields)) ? $by : $default_order_by;
		$result['by'] = $by;
		
		// parse query
		$filter = $this->parse_query($query);
		$result['filter'] = $filter;
		
		// field selection ?
		if( isset($filter['display']) ) {
			// remove unknown fields from display filter
			foreach ($filter['display'] as $i => $field) {
				if( !in_array($field, $this->fields) ) {
					unset($filter['display'][$i]);
				}
			}
			// set display options
			$select = implode(",", $filter['display']);
		} else {
			// fallback
			$select = implode(",", $this->fields);
		}
	
        // starting query
        $this->db->start_cache();
        $query =  $this->db->select($select)
                  ->from($this->table)
                  ->order_by($by, $order);
		
		// search query ?
		if ( isset($filter['search']) ) {
			$query->where('MATCH ('.$select.') AGAINST (\''.$filter['search'].'\' IN BOOLEAN MODE)', NULL, FALSE);
		}
				  
        // filter query with likes?
        if ( isset($filter['like'])) {
	        foreach ($filter['like'] as $field => $value) {
	        	// 'like'-clause only for known fields
				if( in_array($field, $this->fields) ) {
					$query->like($field,$value);
				}	            
	        }       	
        }
		$this->db->stop_cache();
		
		// count
		$result['count'] = $this->db->count_all_results($this->table);
		
		$query->limit($limit, $offset);
		$result['data'] = $query->get();
       
       	$this->db->flush_cache();
        return $result;
    }
	
	protected function parse_query($query) {
		if ($query = 'all') return FALSE;
		
		parse_str($query, $filter);
		foreach ($filter as $key => $value) {
			// display options
			if( $key == 'display' ) {
				// seperate display values with commas
				$filter['display'] = explode(' ', $filter['display']);
				// remove unwanted fields from table (this is done to remove them from the view template)
				foreach ($data['fields'] as $key => $value) {
					if( !in_array($key, $filter['display']) )
						unset($data['fields'][$key]);
				}
			// search query					
			} elseif ($key == 'search') {
				// do nothing (for now) TODO the parse_str has removed the + is that ok?
			// if there are fields left => these are 'like'-clauses
			} else {
				$filter['like'][$key] = $value;
				unset($filter[$key]);
			}
		}
		return $filter;		
	}
	
}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */