<?php
	// set url values for quick filters
	$query_string_display 	= isset($filter['display']) ? create_query_string($filter, 'display') : FALSE;
	$query_string_like 		= isset($filter['like']) ? create_query_string($filter, 'like') : FALSE;
	$query_string_search	= isset($filter['search']) ? create_query_string($filter, 'search') : FALSE;
	$url_this_user 			= 'username='.$this->session->userdata('username');

	$hidden['display']		= $query_string_display;

	// delimiter
	$next_display = isset($filter['display']) ? '&' : '';

?>	
<div class="fluid-container sidebar-left">
	
	<aside class="fluid-sidebar">
		
		<div class="page-controls">
			<h1>Orders</h1>
		</div>
		
		<ul class="well nav list">
			<li class="nav-header">All Orders: Status</li>
	        <li <?php echo ( empty($filter['like']['work_status']) && empty($filter['like']['username']) ) ? 'class="active"' : ''; ?>>
	        	<?php echo anchor('orders/view/'.$next_display.$query_string_display,'All' ); ?>
	        </li>
	        <li <?php echo ( (@$filter['like']['work_status'] == 'open') && empty($filter['like']['username']) ) ? 'class="active"' : ''; ?>>
	        	<?php echo anchor('orders/view/work_status=open'.$next_display.$query_string_display,'Open' ); ?>
	        </li>
	        <li <?php echo ( (@$filter['like']['work_status'] == 'ordered') && empty($filter['like']['username']) ) ? 'class="active"' : ''; ?>>
	        	<?php echo anchor('orders/view/work_status=ordered'.$next_display.$query_string_display,'Ordered' ); ?>
	        </li>
	        <li <?php echo ( (@$filter['like']['work_status'] == 'closed') && empty($filter['like']['username']) ) ? 'class="active"' : ''; ?>>
	        	<?php echo anchor('orders/view/work_status=completed'.$next_display.$query_string_display,'Completed' ); ?>
	        </li>			
			<li class="nav-header">My Orders: Status</li>
	        <li <?php echo ( empty($filter['like']['work_status']) && (@$filter['like']['username'] == $this->session->userdata('username')) ) ? 'class="active"' : ''; ?>>
	        	<?php echo anchor('orders/view/'.$url_this_user.$next_display.$query_string_display,'All' ); ?>
	        </li>
	        <li <?php echo ( (@$filter['like']['work_status'] == 'open') && (@$filter['like']['username'] == $this->session->userdata('username')) ) ? 'class="active"' : ''; ?>>
	        	<?php echo anchor('orders/view/'.$url_this_user.'&work_status=open'.$next_display.$query_string_display,'Open' ); ?>
	        </li>
	        <li <?php echo ( (@$filter['like']['work_status'] == 'ordered') && (@$filter['like']['username'] == $this->session->userdata('username')) ) ? 'class="active"' : ''; ?>>
	        	<?php echo anchor('orders/view/'.$url_this_user.'&work_status=ordered'.$next_display.$query_string_display,'Ordered' ); ?>
	        </li>
	        <li <?php echo ( (@$filter['like']['work_status'] == 'closed') && (@$filter['like']['username'] == $this->session->userdata('username')) ) ? 'class="active"' : ''; ?>>
	        	<?php echo anchor('orders/view/'.$url_this_user.'&work_status=completed'.$next_display.$query_string_display,'Completed' ); ?>
	        </li>			
		</ul>
		
	</aside>
	
	<div class="fluid-content">
	<?php echo form_open('orders/actions', '', $hidden); ?>
		
		<div class="page-controls">

			<div class="input-append search">
				<input type="search" placeholder="Search" size="50" name="search">
				<label class="add-on">
					<button type="submit" name="action" value="search">Search</button>
				</label>
		    </div>		
			
			<div class="actions">
				
				<a href="<?php echo base_url();?>orders/new" rel="tooltip" data-original-title="New" class="btn-flat single"><i class="shop"></i></a> 
				
				<div class="btn-group marking-needed">
					<button rel="tooltip" data-original-title="Change Status" value="status" type="submit" name="action" class="btn-flat"><i class="clip"></i></button>
					<button rel="tooltip" data-original-title="Delete" value="delete" type="submit" name="action" class="btn-flat"><i class="trash"></i></button>	  
				</div>
				
				<div class="btn-group">
					<a href="#modal-filter" rel="tooltip" data-original-title="Filter Options" class="btn-flat" data-toggle="modal"><i class="abacus"></i></a>
					<a href="#modal-display" rel="tooltip" data-original-title="Display Options" class="btn-flat" data-toggle="modal"><i class="eye"></i></a>
					<?php if( $filter ) : ?>
					<a href="<?php echo base_url();?>orders/" rel="tooltip" data-original-title="Reset Options" class="btn-flat"><i class="reset"></i></a>
					<?php endif; ?>
				</div>	
				
			</div>		
		</div>
		
		<?php echo $this->session->flashdata('message'); ?>
		
		<?php if( empty($data) ) : ?>
			<div class="row">
				<div class="span8">
					<div class="alert alert-block alert-error">
			            <h4 class="alert-heading">Oh snap! Nothing to display!</h4>
			            <p>Your query didn't return any data. Try to use less filter. You can also reset your querry completely or go to your last setting by using the buttons down below.</p>
			            <p>
			              <a href="<?php echo base_url();?>orders/" class="btn danger small">Reset the query</a> <?php echo isset($_SERVER['HTTP_REFERER']) ? '<a href="'.$_SERVER['HTTP_REFERER'].'" class="btn small">Return to last page</a>' : ''; ?>
			            </p>
		          	</div>
				</div>
			</div>
		<?php else: ?>
		<table>
			
			  <thead>
			  	<?php if( in_array($this->session->userdata('role'), $allowed_to_change_status) ) : ?>
			  	<th class="center">
			  		<?php echo form_checkbox('mark_all', 'all'); ?>
			  	</th>
			  	<?php endif; ?>
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
			      <?php if( in_array($this->session->userdata('role'), $allowed_to_change_status) ) : ?>
			      <td class="center">
			      	<?php echo form_checkbox('marked[]', $item->id); ?>
			      </td>
			      <?php endif; ?>
			      <?php foreach($fields as $field_name => $field_display): ?>
			      <td>
			        <?php echo $item->$field_name; ?><? echo ($field_name == 'price_total') ? ' '.$item->currency : ''; ?>
			      </td>
			      <?php endforeach; ?>
			      <td>
			      	<?php echo anchor('orders/edit/'.$item->id, 'edit', 'class="action edit" title="Edit Order"'); ?>
			      	<?php if( in_array($this->session->userdata('role'), $allowed_to_change_status) || $this->session->userdata('username') == @$item->username) : ?>
			      	<?php echo anchor('orders/delete/'.$item->id, 'delete', 'class="action delete" title="Delete Order"'); ?>
			      	<?php endif; ?>
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

		<?php endif; ?>
	
	<?php echo form_close(); ?>	
	</div>
</div>
<div id="modal-filter" class="modal hide fade">
            <div class="modal-header">
              <a href="#" class="close" data-dismiss="modal">×</a>
              <h3>Filter Options</h3>
            </div>
            <div class="modal-body">
				Comming soon
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
            <?php echo form_open('orders/change_view'); ?>
            <?php if ( $query_string_like ) : ?>
            	<input type="hidden" name="like" value="<?php echo $query_string_like; ?>">
            <?php endif; ?>
            <?php if ( $query_string_search ) : ?>
            	<input type="hidden" name="search" value="<?php echo $query_string_search; ?>">
            <?php endif; ?>            
            <div class="modal-body">
            	<p class="help-block"><span class="label notice">Notice</span> If the displayed information is too cluttered, deselect some fields below. This will temporaly remove them from your view and should help you stay on top of things.</p>
				<div class="checklist">
					<fieldset class="left">
			            <label class="checkbox">
			              <input type="checkbox" value="date_created" name="display[]" <?php echo isset($fields['date_created']) ? 'checked="yes"' : ''; ?>>
			              Date Created
			            </label>						
			            <label class="checkbox">
			              <input type="checkbox" value="CAS_description" name="display[]" <?php echo isset($fields['CAS_description']) ? 'checked="yes"' : ''; ?>>
			              CAS / Description
			            </label>						
			            <label class="checkbox">
			              <input type="checkbox" value="vendor" name="display[]" <?php echo isset($fields['vendor']) ? 'checked="yes"' : ''; ?>>
			              Vendor
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="catalog_number" name="display[]" <?php echo isset($fields['catalog_number']) ? 'checked="yes"' : ''; ?>>
			              Catalog Number
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="price_unit" name="display[]" <?php echo isset($fields['price_unit']) ? 'checked="yes"' : ''; ?>>
			              Unit Price
			            </label>						
					</fieldset>
					<fieldset class="right">
			            <label class="checkbox">
			              <input type="checkbox" value="quantity" name="display[]" <?php echo isset($fields['quantity']) ? 'checked="yes"' : ''; ?>>
			              Quantity
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="price_total" name="display[]" <?php echo isset($fields['price_total']) ? 'checked="yes"' : ''; ?>>
			              Total Price
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="account" name="display[]" <?php echo isset($fields['account']) ? 'checked="yes"' : ''; ?>>
			              Account
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="work_status" name="display[]" <?php echo isset($fields['work_status']) ? 'checked="yes"' : ''; ?>>
			              Work Status
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="username" name="display[]" <?php echo isset($fields['username']) ? 'checked="yes"' : ''; ?>>
			              Ordered by
			            </label>							
					</fieldset>
				</div>            		            		            		            
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn large primary">Apply Changes</button>
              <a data-dismiss="modal" class="btn large" href="#">Cancel</a>
            </div>
            <?php echo form_close(); ?>
</div>