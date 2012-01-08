<h1 class="page-header">Change Role of Users <small>Keep on rolling!</small></h1>
<?php echo form_open('admin/users/role','class="action"'); ?>
<?php 
	$options_role = array (
		'inactive' => 'inactive',
		'user' => 'User',
		'purchaser' => 'Purchaser',
		'admin' => 'Admin'
    );
?>
	<h3>The role of the following users will be changed:</h3>
	
	<table>
	  <thead>
	    <?php foreach( $fields as $field_name => $field_display): ?>
	    <th>
	      <?php echo $field_display; ?>
	    </th>
	    <?php endforeach; ?>
	  </thead>
	  
	  <tbody>
	    <?php foreach($users as $user): ?>
	    <tr>
	      <?php foreach($fields as $field_name => $field_display): ?>
	      <td>
	      	<?php
		      	if( $field_name == 'role' ) {
			    	echo form_dropdown('role['.$user->username.']', $options_role, $user->$field_name, 'id="role-'.$user->username.'" class="span3"');
		      	} else {
		        	echo $user->$field_name;
		        }
			?>
	      </td>
	      <?php endforeach; ?>
	    </tr>
	    <?php endforeach; ?>			
	  </tbody>
	  
	</table>
	
	<div class="table-actions">
		<div class="dropdown">
			<a class="btn-flat group" href="#"><span></span>Set Roles to</a>
			<ul id="set-role" class="dropdown-slider">
				<li data-value="inactive">Inactive</li>
				<li data-value="user">User</li>
				<li data-value="purchaser">Purchaser</li>	
			</ul>
		</div>
	</div>
	<div class="center">
    	<input name="submit-role" type="submit" value="Submit" class="btn danger">&nbsp;<a class="btn" type="reset" href="<?php echo @$_SERVER['HTTP_REFERER']; ?>" >Cancel</a>
	</div>
<?php echo form_close(); ?>