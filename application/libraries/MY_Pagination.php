<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Pagination extends CI_Pagination {

    var $prev_link = '&larr; Previous';
    var $prev_tag_open = '<li class="prev">';
    var $prev_tag_close = '</li>';
    var $next_link = 'Next &rarr;';
    var $next_tag_open = '<li class="next">';
    var $next_tag_close = '</li>';

    var $cur_tag_open = '<li class="active"><a href="#">';
    var $cur_tag_close = '</a></li>';
    var $num_tag_open = '<li>';
    var $num_tag_close = '</li>';

	// new vars (for disabled links)
	var $prev_tag_open_disabled		= '<li class="prev disabled"><a href="#">';
	var $prev_tag_close_disabled	= '</a></li>';
	var $next_tag_open_disabled		= '<li class="next disabled"><a href="#">';
	var $next_tag_close_disabled	= '</a></li>';
	
	var $use_page_numbers = TRUE;
	
	function create_links() {
		$output = parent::create_links();
		// add previous (disabled) link
		if ( $this->cur_page == 1 && $output != '' ){
			$prev = $this->prev_tag_open_disabled.$this->prev_link.$this->prev_tag_close_disabled;
			$output =	$prev . $output;			
		}
		// add next (disabled) link
		if ( $this->cur_page >= ceil($this->total_rows / $this->per_page) ){
			$output .=	$this->next_tag_open_disabled.$this->next_link.$this->next_tag_close_disabled;
		}
		return $output;
	}
	
}

/* End of file MY_Paginationphp */