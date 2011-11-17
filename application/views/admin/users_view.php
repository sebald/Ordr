<?php
	$options_field = array (
  		  'username' 	=> 'Username',
  		  'first_name' 	=> 'First Name',
  		  'last_name' 	=> 'Last Name',
  		  'email' 		=> 'Email',
  		  'role'		=> 'Role'
	);
	$attr_form_filter = array(
          'class'       => 'pre-table-action'
	);
	$attr_input_search = array(
          'name'        => 'search',
          'class'       => 'span4',
          'size'        => '30'
	);
	$attr_submit_search = array(
          'class'       => 'btn primary'
	);		
	$attr_input_filter = array(
          'name'        => 'filter[term]',
          'class'       => 'span3',
          'size'        => '30'
	);
	$attr_submit_filter = array(
          'class'       => 'btn primary'
	);
	parse_str($query, $filter);
	$keys = array_keys($filter);
	$vals = array_values($filter);		
?>
<h1 class="page-header">Manage Users <small>Activate, add, delete,...</small></h1>
<?php echo $this->session->flashdata('message'); ?>

<?php echo form_open('admin/users/search', $attr_form_filter); ?>
<div class="right">	
	<?php echo form_input($attr_input_search, ($keys[0] == 'search') ? $vals[0] : ''); ?>
	<?php echo form_submit($attr_submit_search, 'Search'); ?>
</div>
<?php echo form_close(); ?>  

<?php echo form_open('admin/users/filter', $attr_form_filter); ?>
<div class="right">
	<?php echo form_dropdown('filter[by]', $options_field, $keys[0], 'class="span2"'); ?>	
	<?php echo form_input($attr_input_filter, (isset($vals[0]) && $keys[0] != 'search') ? $vals[0] : ''); ?>
	<?php echo form_submit($attr_submit_filter, 'Filter'); ?>
</div>
<?php echo form_close(); ?>         

<?php echo form_open('admin/users/actions'); ?>
<table>
  <thead>
  	<th class="span1 center">
  		<?php echo form_checkbox('mark_all', 'all'); ?>
  	</th>
    <?php foreach( $fields as $field_name => $field_display): ?>
    <th class="sortable blue header<?php if ($by == $field_name) echo ($order == 'asc') ? ' headerSortUp' : ' headerSortDown'; ?>">
      <?php echo anchor("admin/users/view/$filter/$field_name/" .
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