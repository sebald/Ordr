<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends MY_Controller {

	private $allowed_to_change_status = array ('purchaser', 'admin');

    public function index() {
      	redirect('orders/view');
    }

	/**
	 * 	Redirecting to the requested action.
	 * 	The redirect is needed because there is only one form action, but there are more than
	 * 	one actions for table data.
	 */
	public function actions() {
		switch ($this->input->post('action')) {
			case 'delete':
				$this->session->set_flashdata('id', $this->input->post('marked'));
				redirect('orders/delete');
				break;
			case 'status':
				$this->session->set_flashdata('id', $this->input->post('marked'));
				redirect('orders/status');
				break;
			case 'search':
				$query = $this->input->post('display') ? $this->input->post('display').'&' : '';
				$query .= 'search='.$this->input->post('search');
				redirect('orders/view/'.$query.'/');
				break;
			case 'export':
				$this->session->set_flashdata('like', $this->input->post('like'));
				$this->session->set_flashdata('search', $this->input->post('search'));
				redirect('orders/export');
				break;
			default:
				$msg = create_alert_message('warning', 'No can do!', 'Unkown action.');
				$this->session->set_flashdata('message', $msg);
				redirect($_SERVER['HTTP_REFERER']);
				break;
		}
	}

	public function new_order_splash(){
		// get common consumables
		$this->load->model('consumables_model');
		foreach (get_consumable_categories() as $category) {
			$filter['category'] = $category;
			$consumables = $this->consumables_model->search(FALSE, 0, 'CAS_description', 'asc', $filter);
			$data['categories'][$category] = $consumables['consumables']->result();
		}

		// data for autocomplete of common consumables
		$result = $this->consumables_model->get_all('CAS_description')->result();
		$data['common_consumables'] = array();
		foreach ($result as $row) {
			array_push($data['common_consumables'], $row->CAS_description);
		}

		$data['main_content'] = 'orders/new_order_splash';
		$this->load->view('layout/template', $data);
	}

	public function new_order() {
		// field name, error message, validation rules
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('CAS_description', 'CAS / Description', 'trim|required|max_length[80]');
	    $this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[30]');
	    $this->form_validation->set_rules('catalog_number', 'Catalog Number', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('vendor', 'Vendor', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('package_size', 'Package Size', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('price_unit', 'Unit Price', 'trim|to_decimal|required|decimal|max_length[10]');
		$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|is_natural_no_zero|max_length[5]');
		$this->form_validation->set_rules('account', 'Account', 'trim|max_length[40]');
		$this->form_validation->set_rules('comment', 'Comment', 'trim|max_length[140]');

		// data for autocomplete of common consumables
		$this->load->model('consumables_model');
		$result = $this->consumables_model->get_all('CAS_description')->result();
		$data['common_consumables'] = array();
		foreach ($result as $row) {
			array_push($data['common_consumables'], $row->CAS_description);
		}

		// did a autocomplete happen?
		$data['order'] =  $this->session->flashdata('consumable');

		// process the order
	    if( $this->form_validation->run() == FALSE ) {
	        $data['main_content'] = 'orders/new_order';
	    } else {
	        $this->load->model('orders_model');
	        if($this->orders_model->create()) {
	        	$msg = create_alert_message('success', 'Order placed successfully!!', 'You will be notified as soon a purchaser has processed your order.');
				$this->session->set_flashdata('message', $msg);
	        	redirect('orders/view');
	    	} else {
	        	$msg = create_alert_message('error', 'Something went wrong!!', 'The consumables has not been added to the databse.');
				$this->session->set_flashdata('message', $msg);
	        	$data['main_content'] = 'orders/new_order';
	        }
	    }
      	$this->load->view('layout/template', $data);
	}

	public function view($query = 'all', $by = 'date_created', $order = 'desc', $page = 1) {
		// set defaults
        $limit = 15;
		$offset = ($page-1)*$limit;

		// get orders
        $this->load->model('orders_model');
        $result = $this->orders_model->query($limit, $offset, $by, $order, $query);

		// set stuff to pass to the view
        $data['data'] 	= $result['data']->result();
        $data['count'] 	= $result['count'];
		$data['filter'] = $result['filter'];
		$data['order'] 	= $result['order'];
		$data['by'] 	= $result['by'];
		$data['query'] 	= $query;

		$data['allowed_to_change_status'] = $this->allowed_to_change_status;

		// set field name for the view (these fields will be displayed)
		if( isset($result['filter']['display']) ) {
			$data['fields'] = $this->orders_model->get_field_names($result['filter']['display']);
		// default display
		} else {
	        $data['fields'] = array(
	        			'date_created'			=> 	'Date created',
	                    'CAS_description' 		=> 	'CAS / Description',
	                    'price_total' 			=> 	'Price Total',
	                    'work_status'			=>	'Status',
	                    'username'				=>	'Placed by'
	        );
		}

        // pagination config
        $config['base_url'] = site_url("orders/view/$query/$by/$order");
        $config['total_rows'] = $data['count'];
        $config['per_page'] = $limit;
        $config['uri_segment'] = 6;
        $config['num_links'] = 5;

        // pagination
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['main_content'] = 'orders/view';
        $this->load->view('layout/template', $data);
	}

	public function edit($id = FALSE) {
		// get order
		if ( $this->input->post() ) {
			// use post if some form errors occured
			$data['order'] = (object) $this->input->post();
		} elseif( $id ) {
			$this->load->model('orders_model');
			$data['order'] = $this->orders_model->get($id)->row(0);
		} else {
	        	$msg = create_alert_message('error', 'No order specified!!', 'You have been redirected to the order overview.');
				$this->session->set_flashdata('message', $msg);
	        	redirect('orders/view');
		}

		// field name, error message, validation rules
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('CAS_description', 'CAS / Description', 'trim|required|max_length[80]');
	    $this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[30]');
	    $this->form_validation->set_rules('catalog_number', 'Catalog Number', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('vendor', 'Vendor', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('package_size', 'Package Size', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('price_unit', 'Unit Price', 'trim|to_decimal|required|decimal|max_length[10]');
		$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|is_natural_no_zero|max_length[5]');
		$this->form_validation->set_rules('account', 'Account', 'trim|max_length[40]');
		$this->form_validation->set_rules('comment', 'Comment', 'trim|max_length[140]');

		// set who can change the work status
		$data['allowed_to_change_status'] = $this->allowed_to_change_status;

	    if( $this->form_validation->run() == FALSE ) {
	        $data['main_content'] = 'orders/edit_order';
	    } else {
	        $this->load->model('orders_model');
			$result = $this->orders_model->update();
	        if( $result ) {
	        	$msg = create_alert_message('success', 'Order updated successfully!!', 'The Order <em>#'.$this->input->post('id').'</em> has been updated.');
				$this->session->set_flashdata('message', $msg);

				if( $result === 'approval' || $result === 'ordered' || $result === 'completed' )
					$this->notification($result, $this->input->post('username'), $this->input->post('CAS_description'), current_url());

	        	redirect('orders/view');
	    	} else {
	        	$msg = create_alert_message('error', 'Something went wrong!!', 'The order could not be updated.');
				$this->session->set_flashdata('message', $msg);
	        	$data['main_content'] = 'orders/edit_order';
	        }
	    }
        $this->load->view('layout/template', $data);
	}

	public function delete($id = FALSE) {
		if( $id == FALSE) {
			$id = $this->session->flashdata('id');
			$this->session->keep_flashdata('id');
		} else {
			$this->session->set_flashdata('id', $id);
		}

		if( $this->input->post('submit-delete') == 'confirm') {
			$this->load->model('orders_model');
			if ( $this->orders_model->delete($id) ) {
				$msg = create_alert_message('success', 'Order deleted successfull!', 'The consumable <em>#'.$id.'</em> has been deleted.');
				$this->session->set_flashdata('message', $msg);
			} else {
				$msg = create_alert_message('error', 'Something went wrong!', 'The Order <em>#'.$id.'</em> could not be deleted.');
				$this->session->set_flashdata('message', $msg);
			}
			redirect('orders/view');
		}

		$this->load->model('orders_model');
		$query = $this->orders_model->get($id, 'id', 'id, date_created, CAS_description, work_status, username');

		$this->load->library('table');
		$this->table->set_heading(array('#', 'Date Created', 'CAS / Description', 'Status', 'Placed by'));
		$this->table->set_template(array ( 'table_open'  => '<table class="table">' ));
        $data['table'] = $this->table->generate($query);

		$data['main_content'] = 'orders/delete_order';
		$this->load->view('layout/template', $data);
	}
	
	public function reorder($id = FALSE) {
        if ($id) {
			$this->load->model('orders_model');
			$old_order = $this->orders_model->get($id)->row(0);
			if (!$old_order) {
	        	$msg = create_alert_message('error', 'Order not found!!', 'You have been redirected to the order overview.');
				$this->session->set_flashdata('message', $msg);
	        	redirect('orders/view');
			}
		} else {
	        	$msg = create_alert_message('error', 'No order specified!!', 'You have been redirected to the order overview.');
				$this->session->set_flashdata('message', $msg);
	        	redirect('orders/view');
		}
		
		# copy the old order values to a new order, but only the things needed
		# reset the id to null to place a new order
        # unused fields for reference:
        # username, work_status, date_created,, date_ordered, date_completed, date_modified

		$new_order = new stdClass();
        $new_order->id              = NULL;
        $new_order->vendor          = $old_order->vendor;
        $new_order->catalog_number  = $old_order->catalog_number;
        $new_order->CAS_description = $old_order->CAS_description;
        $new_order->category        = $old_order->category;
        $new_order->package_size    = $old_order->package_size;
        $new_order->price_unit      = $old_order->price_unit;
        $new_order->quantity        = $old_order->quantity;
        $new_order->price_total     = $old_order->price_total;
        $new_order->currency        = $old_order->currency;
        $new_order->comment         = $old_order->comment;
        $new_order->account         = $old_order->account;
        
		$this->session->set_flashdata('consumable', $new_order);
		redirect('orders/new');
	}

	public function status() {
		$this->load->model('orders_model');

		if( $this->input->post('submit-status') == 'confirm' ) {
			foreach ($this->input->post('work_status') as $id => $work_status) {
				$data['work_status'] = $work_status;
				$this->orders_model->update($id, $data);
			}
			$msg = create_alert_message('success', 'Status update successfull!', count($this->input->post('work_status')).' statuses updated.');
			$this->session->set_flashdata('message', $msg);
			redirect('orders/view');
		}

		$data['orders'] = $this->orders_model->get($this->session->flashdata('id'))->result();
		$data['fields'] = array(
                    'id'    	  		=> '#',
                    'CAS_description'  	=> 'CAS / Description',
                    'work_status'   	=> 'Status',
                    'username'       	=> 'Placed by'
        );

		$data['main_content'] = 'orders/status_order';
        $this->load->view('layout/template', $data);
	}

	public function export() {
		$query = FALSE;
		if( $this->session->flashdata('search') && $this->session->flashdata('like') ){
			$query = $this->session->flashdata('like').'&'.$this->session->flashdata('search');
		} else {
			$query = $this->session->flashdata('like').$this->session->flashdata('search');
		}

		// get orders
        $this->load->model('orders_model');
        $result = $this->orders_model->query(FALSE, 0, 'date_created', 'desc', $query);

		$this->load->dbutil();
		$delimiter = ";";
		$data = str_replace('.', ',', $this->dbutil->csv_from_result($result['data'], $delimiter));

		get_timezone();
		header("Content-type: text/csv");
		header("Content-disposition: attachment;filename=ordr_".date('Y-m-d_H:i:s').".csv");
        echo "$data";
	}

	public function change_view() {
		$display 	= create_query_string($_POST, 'display');
		$like 		= isset($_POST['like']) ? '&'.$_POST['like'] : '';
		$search 	= isset($_POST['search']) ? '&'.$_POST['search'] : '';
		redirect('orders/view/'.$display.$like.$search);
	}

	public function autocomplete_order($item = FALSE, $by = 'CAS_description') {
		if( $item == FALSE )
			$item = $this->input->post('search');
		$this->load->model('consumables_model');
		$result = $this->consumables_model->get($item, $by)->row(0);

		if( $result == FALSE ) {
			$msg = create_alert_message('error', 'Something went wrong!', 'There is no consumable in the database that maches your search.');
			$this->session->set_flashdata('message', $msg);
		}

		$this->session->set_flashdata('consumable', $result);
		redirect('orders/new');
	}

	private function notification($status, $username, $CAS_description, $visit){
		// dont send anything if the user has changed the status of his/her own order
		if( $this->session->userdata('username') == $username )
			return FALSE;

		// get email adress
		$this->load->model('user_model');
		$to = $this->user_model->get($username, 'username', 'email')->row(0)->email;

		$subject = '[ordr] Notification for '.$CAS_description;
		$from = str_replace('http://', '', base_url());
		$from = str_replace('www.', '', $from);

		// msg
		$data['item'] = $CAS_description;
		$data['status'] = $status;
		$data['link'] = $visit;
		$msg = $this->load->view('email/notification', $data, true);

		//headers
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: '.$username.' <'.$to.'>' . "\r\n";
		$headers .= 'From: ordr <noreply'.$from.'>' . "\r\n";

		// send
  		mail($to, $subject, $msg, $headers);
	}
}
