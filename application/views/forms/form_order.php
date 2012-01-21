<?php $this->load->helper('taxonomies'); ?>
<?php $mode = empty($mode) ? 'new' : $mode; ?>

<?php
	$hidden = '';
	if($mode == 'edit') {
		$hidden = array(
						'id'				=>	$order->id,
						'work_status'		=> 	$order->work_status,
						'username'			=>	$order->username,
						'date_created'		=>	$order->date_created,
						'date_modified'		=>	$order->date_modified,
						'date_ordered'		=>	$order->date_ordered,
						'date_completed'	=> 	$order->date_completed
						);		
	}
?>

<?php echo form_open($action, 'class="form-horizontal" autocomplete="off"', $hidden); ?>
	
	<?php if( $mode == 'edit' ) : ?>
	<legend>Order Information</legend>
	<fieldset class="control-group<?php echo !in_array($this->session->userdata('role'),$allowed_to_change_status) ? ' information' : '';?>">
      <label for="work_status" class="control-label">Status</label>
      <div class="controls">
      	<?php if( in_array($this->session->userdata('role'), $allowed_to_change_status) ) : ?>
      		<select name="work_status" class="span2">
			<?php foreach (get_work_statuses() as $s) { ?>
				<option<?php echo (isset($order->work_status) && (@$order->work_status == $s) ) ? ' selected="selected"' : ''; ?>><?php echo $s; ?></option>
			<?php } ?>
        	</select>
      	<?php else : ?>
        	<p><?php echo create_work_status_html($order->work_status); ?></p>
        <?php endif; ?>
      </div>
    </fieldset>
    <fieldset class="control-group information">
      <label for="date_created" class="control-label">Placed by</label>
      <div class="controls">
        <p><?php echo anchor('orders/view/username='.$order->username, $order->username);?> (click to view all orders from user)</p>
      </div>
    </fieldset>    
    <fieldset class="control-group information">
      <label for="date_created" class="control-label">Placed on</label>
      <div class="controls">
        <p><?php echo $order->date_created; ?></p>
      </div>
    </fieldset>
    <fieldset class="control-group information">
      <label for="date_created" class="control-label">Last modified on</label>
      <div class="controls">
        <p><?php echo ($order->date_modified == '0000-00-00 00:00:00') ? $order->date_modified : 'never'; ?></p>
      </div>
    </fieldset>
    <fieldset class="control-group information">
      <label for="date_created" class="control-label">Ordered on</label>
      <div class="controls">
        <p><?php echo ($order->date_ordered == '0000-00-00 00:00:00') ? $order->date_ordered : 'not yet'; ?></p>
      </div>
    </fieldset>
    <fieldset class="control-group information">
      <label for="date_created" class="control-label">Completed on</label>
      <div class="controls">
        <p><?php echo ($order->date_completed == '0000-00-00 00:00:00') ? $order->date_completed : 'not yet'; ?></p>
      </div>
    </fieldset> 
	<?php endif; ?>
	
	<?php
		// load template based on work status
		if( empty($order->work_status) ) {
			// new order
			$this->load->view('forms/form_order_editable');
		} elseif( in_array($this->session->userdata('role'), $allowed_to_change_status) ) {
			// user is allowd to change status: can always edit
			$this->load->view('forms/form_order_editable');
		} elseif( $order->work_status == 'open' && $order->username == $this->session->userdata('role') ) {
			// open order: user placed the order and purchaser/admins can edit
			$this->load->view('forms/form_order_editable');
		} else {
			// ordered/completed or new order but user didnt place it: user can not edit 
			$this->load->view('forms/form_order_closed');			
		}
	?>
      					        
<?php echo form_close(); ?>