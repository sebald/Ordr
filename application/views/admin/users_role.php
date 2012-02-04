<div class="container-fluid">
		
		<div class="page-controls">
			<h1>Change Role of User(s)</h1>
		</div>
		
		<div class="row">
			<div class="span11">

				<div class="action-header">
					<h3>The role of the following user(s) will be changed:</h3>  				
				</div>
				
				<?php echo form_open('admin/users/role'); ?>
					<table class="table">
						
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
					      	<?php if( $field_name == 'role' ) : ?>
							    <select id="role-<?php echo $user->username;?>" name="role[]" class="span2">
							    		<option value="new">New</option>
					            	<?php foreach ($user_categories as $c) { ?>
										<option value="<?php echo $c; ?>"><?php echo $c; ?></option>
									<?php } ?>
					            </select>
						    <?php else :
						        	echo $user->$field_name;
								endif;
							?>
					      </td>
					      <?php endforeach; ?>
					    </tr>
					    <?php endforeach; ?>			
					  </tbody>
					
					</table>
					
					<fieldset class="form-actions">
						<div class="right">
				    		<button name="submit-role" type="submit" value="Submit" class="btn btn-large btn-danger">Submit</button>
				    		<a href="<?php echo @$_SERVER['HTTP_REFERER']; ?>" type="reset" class="btn btn-large">Cancel</a>							
						</div>
						
						<div class="btn-group quick-action left" data-action="role">
			              <a data-value="User" href="#" class="btn btn-large btn-primary">Set all to User</a>
			              <a href="#" data-toggle="dropdown" class="btn btn-large btn-primary dropdown-toggle"><span class="caret"></span></a>
			              <ul class="dropdown-menu">
			                <li><a data-value="Inactive" href="#">Set all to Inactive</a></li>
			                <li><a data-value="Purchaser" href="#">Set all to Purchaser</a></li>
			              </ul>
			            </div>						
						
					</fieldset> 
							
				<?php echo form_close(); ?>				
			</div>
		</div>		

</div>
