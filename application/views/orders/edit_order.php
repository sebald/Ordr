<div class="container-fluid">
		<div class="page-controls">
			
			<h1>Edit Order #<?php echo $order->id; ?></h1>
			
		</div>
		<div class="row">
			<div class="span8">
			    
			    <?php echo $this->session->flashdata('message'); ?>
				
				<?php if( $order->work_status == 'ordered' && !in_array($this->session->userdata('role'), $allowed_to_change_status) ) : ?>
					<div class="alert alert-block">
				        <h4 class="alert-heading">Warning!</h4>
				        <p>Once an item is ordered you can not edit it anymore. Only viewing is allowed. If you really need to change something please contact an purchaser immediately.</p>
				    </div>
				<?php elseif( $order->work_status == 'approval' && !in_array($this->session->userdata('role'), $allowed_to_change_status) ) : ?>    
					<div class="alert alert-block">
				        <h4 class="alert-heading">Warning!</h4>
				        <p>Once an item is awaiting approval you can not edit it anymore. Only viewing is allowed. If some of the information displayed here is wrong please contact an purchaser immediately.</p>
				    </div>
				<?php elseif( $order->work_status == 'completed' && !in_array($this->session->userdata('role'), $allowed_to_change_status) ) : ?>    
					<div class="alert alert-block">
				        <h4 class="alert-heading">Warning!</h4>
				        <p>Once an item is completed you can not edit it anymore. Only viewing is allowed. If some of the information displayed here is wrong please contact an purchaser immediately.</p>
				    </div>
				<?php else : ?>
					<div class="alert alert-block alert-info">
				        <h4 class="alert-heading">You can only view this order!</h4>
				        <p>Since this is not your order you are only allowed to view the order.</p>
				    </div>									    
				<?php endif; ?>
				
				<?php $data['order'] = isset($order) ? $order : FALSE; ?>
				<?php $data['mode'] = 'edit'; ?>
				<?php $data['action'] = 'orders/edit/'.$order->id; ?>
				<?php $this->load->view('forms/form_order', $data); ?>
				
			</div>
		</div>
</div>
