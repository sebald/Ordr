<?php  ?>

<div class="container-fluid">
		
		<div class="page-controls">
			<h1>Change Status of Order(s)</h1>
		</div>
		
		<div class="row">
			<div class="span11">

				<div class="action-header">
					<h3>The status of the following order(s) will be changed:</h3>  				
				</div>
				
				<?php echo form_open('orders/status'); ?>
					<table class="table">
						
					  <thead>
					    <?php foreach( $fields as $field_name => $field_display): ?>
					    <th>
					      <?php echo $field_display; ?>
					    </th>
					    <?php endforeach; ?>
					  </thead>
					  
					  <tbody>
					    <?php foreach($orders as $order): ?>
					    <tr>
					      <?php foreach($fields as $field_name => $field_display): ?>
					      <td>
					      	<?php if( $field_name == 'work_status' ) : ?>
							    <select name="work_status[<?php echo $order->id;?>]" class="span2">
					            	<?php foreach (get_work_statuses() as $s) { ?>
										<option value="<?php echo $s; ?>"><?php echo $s; ?></option>
									<?php } ?>
					            </select>
						    <?php else :
						        	echo $order->$field_name;
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
				    		<button name="submit-status" type="submit" value="confirm" class="btn btn-large btn-danger">Submit Change</button>
				    		<a href="<?php echo @$_SERVER['HTTP_REFERER']; ?>" type="reset" class="btn btn-large">Cancel</a>							
						</div>
						
						<div class="btn-group quick-action left" data-action="work_status">
			              <a data-value="ordered" href="#" class="btn btn-large btn-primary">Set all as ordered</a>
			              <a href="#" data-toggle="dropdown" class="btn btn-large btn-primary dropdown-toggle"><span class="caret"></span></a>
			              <ul class="dropdown-menu">
			                <li><a data-value="approved" href="#">Set all as approved</a></li>
			                <li><a data-value="completed" href="#">Set all as completed</a></li>
			              </ul>
			            </div>						
						
					</fieldset> 
							
				<?php echo form_close(); ?>				
			</div>
		</div>		

</div>
