<?php
	$query_display 	= (isset($filter['display'])) ? implode('+',$filter['display']) : '';

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
          'class'       => 'span2',
          'size'        => '30',
          'placeholder' => 'Search'
	);	
	$attr_submit_search = array(
		  'type'		=> 'submit',
          'class'       => 'search',
          'content'		=> 'Search'
	);
?>
<h1 class="page-header">Manage Users <small>Activate, add, delete,...</small></h1>
<?php echo $this->session->flashdata('message'); ?>
<div class="row">
	<aside class="span3">
		<?php echo form_open('admin/users/search', '', (isset($filter['display'])) ? array( 'display' => $query_display ) : ''); ?>
			<div class="input-append search">
				<?php echo form_input($attr_input_search, (isset($filter['search'])) ? $filter['search'] : ''); ?>
				<label class="add-on">
					<?php echo form_button($attr_submit_search); ?>
				</label>
		    </div>
		<?php echo form_close(); ?>
		<div class="filter">
			<h4>Role</h4>
			<ul>
				<?php $parameter = ( $query_display ) ? 'display='.$query_display.'&' : ''; ?>
				<?php $parameter = ( isset($filter['search']) ) ? $parameter.'search='.$filter['search'].'&' : $parameter; ?>
				<li><?php echo anchor('admin/users/view/'.substr($parameter, 0, -1),'Everyone'); ?></li>
				<li><?php echo anchor('admin/users/view/'.$parameter.'role=inactive','Inactive'); ?></li>
				<li><?php echo anchor('admin/users/view/'.$parameter.'role=user','User'); ?></li>
				<li><?php echo anchor('admin/users/view/'.$parameter.'role=purchaser','Purchaser'); ?></li>
				<li><?php echo anchor('admin/users/view/'.$parameter.'role=admin','Admin'); ?></li>
			</ul>
		</div>
		<div class="filter">
			<h4>Display</h4>
			<?php echo form_open('admin/users/changeview'); ?>
			<?php if( empty($filter['display']) ) $filter['display'] = array( 'username', 'first_name', 'last_name', 'email', 'role' ); ?>
			<ul>
				<li class="active">
					<label class="disabled"><input type="checkbox" checked="checked" value="username" name="display[]" disabled="" ><span>Username</span></label>
				</li>
				<li <?php echo (in_array('first_name', $filter['display'])) ? 'class="active"' : ''; ?>>
					<label><input type="checkbox" <?php echo (in_array('first_name', $filter['display'])) ? 'checked="checked"' : ''; ?> value="first_name" name="display[]"><span>First Name</span></label>
				</li>
				<li <?php echo (in_array('last_name', $filter['display'])) ? 'class="active"' : ''; ?>>
					<label><input type="checkbox" <?php echo (in_array('last_name', $filter['display'])) ? 'checked="checked"' : ''; ?> value="last_name" name="display[]"><span>Last Name</span></label>
				</li>
				<li <?php echo (in_array('email', $filter['display'])) ? 'class="active"' : ''; ?>>
					<label><input type="checkbox" <?php echo (in_array('email', $filter['display'])) ? 'checked="checked"' : ''; ?> value="email" name="display[]"><span>Email</span></label>
				</li>
				<li <?php echo (in_array('role', $filter['display'])) ? 'class="active"' : ''; ?>>
					<label><input type="checkbox" <?php echo (in_array('role', $filter['display'])) ? 'checked="checked"' : ''; ?> value="role" name="display[]"><span>Role</span></label>
				</li>
			</ul>
			<hr />
			<button class="btn-flat" type="submit">Change View</button>
			<?php echo form_close(); ?>
		</div>
	</aside>
	<div class="span13">
		
		<?php echo form_open('admin/users/actions'); ?>
		<table>
		  <thead>
		  	<th class="span1 center">
		  		<?php echo form_checkbox('mark_all', 'all'); ?>
		  	</th>
		    <?php foreach( $fields as $field_name => $field_display): ?>
		    <th class="sortable blue header<?php if ($by == $field_name) echo ($order == 'asc') ? ' headerSortUp' : ' headerSortDown'; ?>">
		      <?php echo anchor("admin/users/view/$query/$field_name/" .
		        (($order == 'asc' && $by == $field_name) ? 'desc' : 'asc') ,
		        $field_display); ?>
		    </th>
		    <?php endforeach; ?>
		    <th>
		    	Actions
		    </th>
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
		<div class="table-actions">
			<div class="btn-group">
				<button class="btn-flat group" name="action" type="submit" value="role"><span></span>Role</button>
				<button class="btn-flat delete" name="action" type="submit" value="delete"><span></span>Delete</button>	  
			</div>
		</div>
		<?php echo form_close(); ?>
		    
		<?php if (strlen($pagination)): ?>
		<div class="pagination center">
		  <ul>
		    <?php echo $pagination; ?>
		  </ul>
		</div>
		<div style="clear:both;"></div>
		<?php endif; ?>
	</div>
</div>