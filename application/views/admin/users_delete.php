<div class="container-fluid">
		
		<div class="page-controls">
			<h1>Delete User(s)</h1>
		</div>
		
		<div class="row">
			<div class="span10">

				<div class="action-header">
					<h3>The following user(s) will be deleted:</h3>  				
				</div>
				
				<?php $seg = ($this->uri->segment(4)) ? '/'.$this->uri->segment(4) : '' ; ?>
				<?php echo form_open('admin/users/delete'.$seg,'class="action"'); ?>
					
					<?php echo $table_users; ?>
					
					<fieldset class="form-actions">
						<div class="right">
				    		<button name="submit-delete" type="submit" value="Submit" class="btn btn-large btn-danger">Submit</button>
				    		<a href="<?php echo @$_SERVER['HTTP_REFERER']; ?>" type="reset" class="btn btn-large">Cancel</a>							
						</div>
					</fieldset>
					
				<?php echo form_close(); ?>
				
			</div>
		</div>
		
</div>

