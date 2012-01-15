<?php
      $attr_input_email = array(
              'name'        => 'email',
              'id'          => 'email',
              'class'       => 'span3',
              'size'        => '30'
            );
?>
<div class="fluid-container">
	<div class="fluid-content">
		
		<div class="page-controls">
			<h1>Account Settings for <?php echo $settings->username; ?></h1>
		</div>
		
		<div class="row">
			<div class="span8">
				<?php echo $this->session->flashdata('message'); ?>
				
				<?php echo form_open('admin/users/edit/'.$settings->username, 'class="form-horizontal"'); ?>
				  	<fieldset class="control-group">
			          <label for="disabledInput" class="control-label">Username</label>
			          <div class="controls">
			          	<input type="text" disabled="" placeholder="<?php echo isset($settings->username) ? $settings->username : ''; ?>" name="username" class="span3 disabled">
			          </div>
				  	</fieldset>
				  	<fieldset class="control-group">
				          <label for="disabledInput" class="control-label">First Name</label>
				          <div class="controls">
				            <input type="text" disabled="" placeholder="<?php echo isset($settings->username) ? $settings->first_name : ''; ?>" name="first_name" class="span3 disabled">
				          </div>
				  	</fieldset>
				  	<fieldset class="control-group">
				          <label for="disabledInput" class="control-label">Lase Name</label>
				          <div class="controls">
				            <input type="text" disabled="" placeholder="<?php echo isset($settings->username) ? $settings->last_name : ''; ?>" name="last_name" class="span3 disabled">
				          </div>
				  	</fieldset>
				  	<fieldset class="control-group<?php if(form_error('email')) echo ' error'; ?>">
				          <label for="email" class="control-label">Email</label>
				          <div class="controls">
					          <?php echo form_input($attr_input_email, set_value('email', isset($settings->email) ? $settings->email : '')); ?>
					          <?php echo form_error('email','<p class="help-block">','</p>'); ?>
				          </div>
					</fieldset>
			        <fieldset class="control-group<?php if(form_error('role')) echo ' error'; ?>">
			          <label for="role" class="control-label">Role</label>
			          <div class="controls">
			            <select name="role" class="span2">
			            	<?php foreach ($user_categories as $c) { ?>
								<option><?php echo $c; ?></option>
							<?php } ?>
			            </select>
			            <?php echo form_error('category','<span class="help-inline">','</span>'); ?>
			          </div>
			        </fieldset>
			        
					<fieldset class="form-actions">
				      <button class="btn large primary" type="submit">Save changes</button>
				      <a href="<?php echo ($this->session->flashdata('referer')) ? $this->session->flashdata('referer') : $_SERVER['HTTP_REFERER']; ?>"" class="btn large" type="reset">Cancel</a>
					</fieldset>			        
			        							  
				<?php echo form_close(); ?>
			</div>
		</div>
		
	</div>
</div>