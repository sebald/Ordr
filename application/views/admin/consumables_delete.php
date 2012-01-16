<div class="fluid-container">
	<div class="fluid-content">
		
		<div class="page-controls">
			<h1>Delete User(s)</h1>
		</div>
		
		<div class="row">
			<div class="span10">

				<div class="action-header">
					<h3>The following consumable will be deleted:</h3>  				
				</div>
				
				<?php echo form_open('admin/consumables/delete/'.$this->uri->segment(4),'class="action"'); ?>
					
					<?php echo $table; ?>
					
					<input type="hidden" name="CAS_description" value="<?php echo $CAS_description; ?>">
					
					<fieldset class="form-actions">
						<div class="right">
				    		<button name="submit-delete" type="submit" value="confirm" class="btn large danger">Confirm</button>
				    		<a href="<?php echo @$_SERVER['HTTP_REFERER']; ?>" type="reset" class="btn large">Cancel</a>							
						</div>
					</fieldset>
					
				<?php echo form_close(); ?>
				
			</div>
		</div>
		
	</div>
</div>
<?php print_a($_POST); ?>
