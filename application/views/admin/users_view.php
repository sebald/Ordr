<h1 class="page-header">Manage Users <small>Activate, add, delete,...</small></h1>
<?php echo $this->session->flashdata('message'); ?>
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