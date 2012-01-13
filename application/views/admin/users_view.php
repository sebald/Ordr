<?php
	$query_display 	= (isset($filter['display'])) ? implode('+',$filter['display']) : '';
	$keep_query = '';
	( isset($filter['search']) ) ? $keep_query['search'] = $filter['search'] : '' ;
	( isset($filter['role']) ) ? $keep_query['role'] = $filter['role'] : '' ;

	$options_field = array (
		'all'			=> 'Anyone',
		'username' 		=> 'Username',
		'first_name' 	=> 'First Name',
		'last_name' 	=> 'Last Name',
		'email' 		=> 'Email',
		'role'			=> 'Role'
	);
	$attr_input_search = array(
          'name'        => 'search',
          'type'		=> 'search',
          'size'        => '30',
          'placeholder' => 'Search'
	);	
	$attr_submit_search = array(
		  'type'		=> 'submit',
          'class'       => 'search',
          'content'		=> 'Search'
	);
?>

<?php echo $this->session->flashdata('message'); ?>
<div class="fluid-container sidebar-left">
	<aside class="fluid-sidebar">
		<div class="page-header">
			<h1>Users</h1>
		</div>
		<ul class="well nav list">
			<li class="nav-header">Role</li>
	        <?php $parameter = ( $query_display ) ? 'display='.$query_display.'&' : ''; ?>
			<?php $parameter = ( isset($filter['search']) ) ? $parameter.'search='.$filter['search'].'&' : $parameter; ?>
			<li <?php echo empty($filter['role']) ? 'class="active"' : ''; ?>><?php echo anchor('admin/users/view/'.substr($parameter, 0, -1),'All' ); ?></li>
			<li <?php echo @($filter['role'] == 'new') ? 'class="active"' : ''; ?>><?php echo anchor('admin/users/view/'.$parameter.'role=new','New' ); ?></li>
			<li <?php echo @($filter['role'] == 'inactive') ? 'class="active"' : ''; ?>><?php echo anchor('admin/users/view/'.$parameter.'role=inactive','Inactive' ); ?></li>
			<li <?php echo @($filter['role'] == 'user') ? 'class="active"' : ''; ?>><?php echo anchor('admin/users/view/'.$parameter.'role=user','User' ); ?></li>
			<li <?php echo @($filter['role'] == 'purchaser') ? 'class="active"' : ''; ?>><?php echo anchor('admin/users/view/'.$parameter.'role=purchaser','Purchaser' ); ?></li>
			<li <?php echo @($filter['role'] == 'admin') ? 'class="active"' : ''; ?>><?php echo anchor('admin/users/view/'.$parameter.'role=admin','Admin' ); ?></li>	
		</ul>		
	
	</aside>
	
	<div class="fluid-content">
		<?php echo form_open('admin/users/actions'); ?>
		<div class="page-header">

			<div class="input-append search">
				<?php echo form_input($attr_input_search, (isset($filter['search'])) ? $filter['search'] : ''); ?>
				<label class="add-on">
					<?php echo form_button($attr_submit_search); ?>
				</label>
		    </div>
	
			<div class="actions">
				
				<a href="#modal-display" rel="twipsy" data-original-title="Display Options" class="btn-flat single" data-toggle="modal"><i class="eye"></i></a>
				
				<div class="btn-group">
					<button rel="twipsy" data-original-title="Change Role" class="btn-flat group" name="action" type="submit" value="role"><i class="group"></i></button>
					<button rel="twipsy" data-original-title="Delete" class="btn-flat delete" name="action" type="submit" value="delete"><i class="trash"></i></button>	  
				</div>
				
			</div>		
			
		</div>
		<table>
			
			  <thead>
			  	<th class="center">
			  		<?php echo form_checkbox('mark_all', 'all'); ?>
			  	</th>
			    <?php foreach( $fields as $field_name => $field_display): ?>
			    <th class="sortable blue header<?php if ($by == $field_name) echo ($order == 'asc') ? ' headerSortUp' : ' headerSortDown'; ?>">
			      <?php echo anchor("admin/users/view/$query/$field_name/" .
			        (($order == 'asc' && $by == $field_name) ? 'desc' : 'asc') ,
			        $field_display); ?>
			    </th>
			    <?php endforeach; ?>
			    <th>Actions</th>
			  </thead>
			  
			  <tbody>
			    <?php foreach($users as $user): ?>
			    <tr>
			      <td class="center">
			      	<?php echo form_checkbox('marked[]', $user->username); ?>
			      </td>
			      <?php foreach($fields as $field_name => $field_display): ?>
			      <td>
			        <?php echo $user->$field_name; ?>
			      </td>
			      <?php endforeach; ?>
			      <td>
			      	<?php echo anchor('admin/users/edit/'.$user->username, 'edit', 'class="action edit" title="Edit User"'); ?>
			      	<?php echo anchor('admin/users/delete/'.$user->username, 'delete', 'class="action delete" title="Delete User"'); ?>
			      </td>
			    </tr>
			    <?php endforeach; ?>			
			  </tbody>
				  
		</table>
		
		<?php if (strlen($pagination)): ?>
		<div class="pagination centered">
		  <ul>
		    <?php echo $pagination; ?>
		  </ul>
		</div>
		<?php endif; ?>
		
		<?php echo form_close(); ?>
	</div>
</div>
<div id="modal-display" class="modal hide fade">
	<?php echo form_open('admin/users/changeview', 'class="checklist"', $keep_query ); ?>
	<?php if( empty($filter['display']) ) $filter['display'] = array( 'username', 'first_name', 'last_name', 'email', 'role' ); ?>
            <div class="modal-header">
              <a href="#" class="close" data-dismiss="modal">×</a>
              <h3>Display Options</h3>
            </div>
            <div class="modal-body">
            	<p class="help-block"><span class="label notice">Notice</span> If the displayed information is too cluttered, deselect some fields below. This will temporaly remove them from your view and should help you stay on top of things.</p>
				<div class="checklist">
					<fieldset class="left">
						<label class="checkbox">
				        <input type="checkbox" checked="checked" value="username" name="display[]" disabled="" >
				              Username
				        </label>
				        <label class="checkbox">
				              <input type="checkbox" <?php echo (in_array('first_name', $filter['display'])) ? 'checked="checked"' : ''; ?> value="first_name" name="display[]">
				              First Name
				        </label>
				        <label class="checkbox">
				              <input type="checkbox" <?php echo (in_array('last_name', $filter['display'])) ? 'checked="checked"' : ''; ?> value="last_name" name="display[]">
				              Last Name
				        </label>
					</fieldset>
					<fieldset class="right">
				        <label class="checkbox">
				              <input type="checkbox" <?php echo (in_array('email', $filter['display'])) ? 'checked="checked"' : ''; ?> value="email" name="display[]">
				              Email
				        </label>
				        <label class="checkbox">
				              <input type="checkbox" <?php echo (in_array('role', $filter['display'])) ? 'checked="checked"' : ''; ?> value="role" name="display[]">
				              Role
				        </label>					
					</fieldset>
				</div>
            </div>
            <div class="modal-footer">
              <button class="btn primary" type="submit">Apply Changes</button>
              <a data-dismiss="modal" class="btn" href="#">Close</a>
            </div>
	<?php echo form_close(); ?>
</div>