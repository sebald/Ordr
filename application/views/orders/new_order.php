<div class="container-fluid">
		<div class="page-controls">
			
			<?php echo form_open('orders/autocomplete', 'class="search-form" autocomplete="off"', (isset($filter['display'])) ? array( 'display' => $query_display ) : ''); ?>
				<div class="input-append search">
					<input type="search" data-provide="typeahead" data-source='<?php echo convert_for_typeahead($common_consumables); ?>' placeholder="Search Consumables" size="50" name="search">
					<label class="add-on">
						<button class="autocomplete" type="submit" name="search_consumable">Search</button>
					</label>
			    </div>
			<?php echo form_close(); ?>	
			
			<h1>Place a new Order</h1>
			
		</div>
		<div class="row-fluid">
			<div class="span8">
				
				<div class="alert alert-info">
			        <strong>Notice!</strong> If you want to order a common consumable use the <em>search on the right</em>. Maybe the consumable is already in the data base. If so, the order form will be filled out for you.
			    </div>
			    
			    <?php echo $this->session->flashdata('message'); ?>
				
				<?php $data['order'] = isset($order) ? $order : FALSE; ?>
				<?php $data['mode'] = 'new'; ?>
				<?php $data['action'] = 'orders/new'; ?>
				<?php $this->load->view('forms/form_order', $data); ?>
				
			</div>
		</div>
</div>
