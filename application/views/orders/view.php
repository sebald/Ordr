<?php
	$attr_input_search = array(
          'name'        => 'search',
          'type'		=> 'search',
          'size'        => '30',
          'placeholder' => 'Search'
	);	
	$attr_submit_search = array(
		  'type'		=> 'submit',
          'content'		=> 'Search'
	);
?>	
<div class="fluid-container sidebar-left">
	
	<aside class="fluid-sidebar">
		
		<div class="page-controls">
			<h1>Orders</h1>
		</div>
		
		<ul class="well nav list">
			<li class="nav-header">My Orders</li>
	        <li class="active"><a href="#" class="nav-item">All</a></li>
	        <li><a href="#" class="nav-item">Open</a></li>
	        <li><a href="#" class="nav-item">On order</a></li>
	        <li><a href="#" class="nav-item">Completed</a></li>	
			<li class="nav-header">Work Status</li>
	        <li><a href="#" class="nav-item">All</a></li>
	        <li><a href="#" class="nav-item">Open</a></li>
	        <li><a href="#" class="nav-item">On order</a></li>
	        <li><a href="#" class="nav-item">Completed</a></li>		
		</ul>
		
	</aside>
	
	<div class="fluid-content">
		
		<div class="page-controls">

			<div class="input-append search">
				<?php echo form_input($attr_input_search, (isset($filter['search'])) ? $filter['search'] : ''); ?>
				<label class="add-on">
					<?php echo form_button($attr_submit_search); ?>
				</label>
		    </div>		
			
			<div class="actions">
				
				<a href="<?php echo base_url();?>orders/new" rel="tooltip" data-original-title="New" class="btn-flat single"><i class="shop"></i></a> 
				
				<div class="btn-group marking-needed">
					<button rel="tooltip" data-original-title="Edit" value="edit" type="submit" name="action" class="btn-flat"><i class="pencil"></i></button>
					<button rel="tooltip" data-original-title="Delete" value="delete" type="submit" name="action" class="btn-flat"><i class="trash"></i></button>	  
				</div>
				
				<div class="btn-group">
					<a href="#modal-filter" rel="tooltip" data-original-title="Filter Options" class="btn-flat" data-toggle="modal"><i class="abacus"></i></a>
					<a href="#modal-display" rel="tooltip" data-original-title="Display Options" class="btn-flat" data-toggle="modal"><i class="eye"></i></a>
				</div>	
				
			</div>		
		</div>
		
		<?php echo $this->session->flashdata('message'); ?>
		
		<table>
			
			  <thead>
			  	<th class="center">
			  		<?php echo form_checkbox('mark_all', 'all'); ?>
			  	</th>
			    <?php foreach( $fields as $field_name => $field_display): ?>
			    <th class="sortable blue header<?php if ($by == $field_name) echo ($order == 'asc') ? ' headerSortUp' : ' headerSortDown'; ?>">
			      <?php echo anchor("orders/view/$query/$field_name/" .
			        (($order == 'asc' && $by == $field_name) ? 'desc' : 'asc') ,
			        $field_display); ?>
			    </th>
			    <?php endforeach; ?>
			    <th>Actions</th>
			  </thead>
			  
			  <tbody>
			    <?php foreach($data as $item): ?>
			    <tr>
			      <td class="center">
			      	<?php echo form_checkbox('marked[]', $item->id); ?>
			      </td>
			      <?php foreach($fields as $field_name => $field_display): ?>
			      <td>
			        <?php echo $item->$field_name; ?><? echo ($field_name == 'price_total') ? ' '.$item->currency : ''; ?>
			      </td>
			      <?php endforeach; ?>
			      <td>
			      	<?php echo anchor('orders/edit/'.$item->id, 'edit', 'class="action edit" title="Edit Order"'); ?>
			      	<?php echo anchor('orders/delete/'.$item->id, 'delete', 'class="action delete" title="Delete Order"'); ?>
			      </td>
			    </tr>
			    <?php endforeach; ?>			
			  </tbody>
				  
		</table>
		
		<?php if (strlen($pagination)): ?>
		<div class="pagination pagination-centered">
		  <ul>
		    <?php echo $pagination; ?>
		  </ul>
		</div>
		<?php endif; ?>

	</div>
</div>
<div id="modal-filter" class="modal hide fade">
            <div class="modal-header">
              <a href="#" class="close" data-dismiss="modal">×</a>
              <h3>Filter Options</h3>
            </div>
            <div class="modal-body">
				TO DO
            </div>
            <div class="modal-footer">
              <a class="btn primary" href="#">Save changes</a>
              <a data-dismiss="modal" class="btn" href="#">Close</a>
            </div>
</div>
<div id="modal-display" class="modal hide fade">
            <div class="modal-header">
              <a href="#" class="close" data-dismiss="modal">×</a>
              <h3>Display Options</h3>
            </div>
            <div class="modal-body">
            	<p class="help-block"><span class="label notice">Notice</span> If the displayed information is too cluttered, deselect some fields below. This will temporaly remove them from your view and should help you stay on top of things.</p>
				<form class="checklist">
					<fieldset class="left">
			            <label class="checkbox">
			              <input type="checkbox" value="user_id" name="display[]">
			              Purchaser
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="vendor" name="display[]">
			              Vendor
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="catalog_number" name="display[]">
			              Catalog Number
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="CAS_description" name="display[]">
			              CAS / Description
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="price_unit" name="display[]">
			              Unit Price
			            </label>						
					</fieldset>
					<fieldset class="right">
			            <label class="checkbox">
			              <input type="checkbox" value="quantity" name="display[]">
			              Quantity
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="price_total" name="display[]">
			              Total Price
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="account" name="display[]">
			              Account
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="work_status" name="display[]">
			              Work Status
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="date_created" name="display[]">
			              Date Created
			            </label>							
					</fieldset>            		            		            		            
				</form>
            </div>
            <div class="modal-footer">
              <a class="btn primary" href="#">Apply Changes</a>
              <a data-dismiss="modal" class="btn" href="#">Close</a>
            </div>
</div>