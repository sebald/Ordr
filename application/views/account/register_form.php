<div class="fluid-container">
	<div class="fluid-content">
		<div class="page-controls">			
			<h1>Create an Account</h1>
		</div>
		
		<div class="row">
			<div class="span10">
				<?php echo $this->session->flashdata('message'); ?>
				
				<?php echo form_open('account/register', 'class="form-horizontal register"'); ?>
					<fieldset class="control-group">
			          <label for="username" class="control-label">Username</label>
			          <div class="controls">
			            <input type="text" disabled="" name="username" id="username" class="span3 disabled">
			            <span class="help-inline">This is automatically generated for you.</span>
			          </div>
			        </fieldset>
					<fieldset class="control-group<?php if(form_error('first_name')) echo ' error'; ?>">
			          <label for="first_name" class="control-label">First Name</label>
			          <div class="controls">
			            <input id="firstname" type="text" name="first_name" class="span3">
			            <?php echo form_error('first_name','<span class="help-inline">','</span>'); ?>
			          </div>
			        </fieldset>
					<fieldset class="control-group<?php if(form_error('last_name')) echo ' error'; ?>">
			          <label for="last_name" class="control-label">Last Name</label>
			          <div class="controls">
			            <input id="lastname" type="text" name="last_name" class="span3">
			            <?php echo form_error('last_name','<span class="help-inline">','</span>'); ?>
			          </div>
			        </fieldset>
					<fieldset class="control-group<?php if(form_error('email')) echo ' error'; ?>">
			          <label for="email" class="control-label">Email</label>
			          <div class="controls">
			            <input type="text" name="email" class="span3">
			            <?php echo form_error('email','<span class="help-inline">','</span>'); ?>
			          </div>
			        </fieldset>
					<fieldset class="control-group<?php if(form_error('password')) echo ' error'; ?>">
			          <label for="password" class="control-label">Password</label>
			          <div class="controls">
			            <input type="password" name="password" class="span3">
			            <?php echo form_error('password','<span class="help-inline">','</span>'); ?>
			          </div>
			        </fieldset>	
					<fieldset class="control-group<?php if(form_error('password2')) echo ' error'; ?>">
			          <label for="password2" class="control-label">Confirm Password</label>
			          <div class="controls">
			            <input type="password" name="password2" class="span3">
			            <?php echo form_error('password2','<span class="help-inline">','</span>'); ?>
			          </div>
			        </fieldset>
					<fieldset class="form-actions">
				    	<button type="submit" class="btn large primary">Create Account</button>
				    	<a href="<?php echo base_url(); ?>" type="reset" class="btn large">Cancel</a>
					</fieldset>			        				        		        				        		        				
				<?php echo form_close(); ?>
			</div>
		</div>
		
	</div>
</div>