<div class="container-fluid">
		
		<div class="page-controls">
			<h1>Delete User(s)</h1>
		</div>
		
		<div class="row">
			<div class="span10">

				<div class="action-header">
					<h3>The following order(s) will be deleted permanently:</h3>  				
				</div>
				
				<?php echo form_open('orders/delete','class="action"'); ?>
					
					<?php echo $table; ?>
					
					<fieldset class="form-actions">
						<div class="right">
				    		<button name="submit-delete" type="submit" value="confirm" class="btn btn-large btn-danger">Confirm Delete</button>
				    		<a href="<?php echo @$_SERVER['HTTP_REFERER']; ?>" type="reset" class="btn btn-large">Cancel</a>							
						</div>
					</fieldset>
					
				<?php echo form_close(); ?>
				
			</div>
		</div>
		
</div>

