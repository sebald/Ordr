<div class="fluid-container">
	<div class="page-controls">
		<h1>Account Settings</h1>
	</div>
	
	<?php echo $this->session->flashdata('message'); ?>

  <?php
      $attr_form = array(
              'class'       => 'settings form-horizontal'
            );
      $attr_input_email = array(
              'name'        => 'email',
              'id'          => 'email',
              'class'       => 'span3',
              'size'        => '30'
            );       
      $attr_input_pwd = array(
              'name'        => 'newpassword',
              'id'          => 'newpassword',
              'class'       => 'span3',
              'size'        => '30'
            );
      $attr_input_pwd2 = array(
              'name'        => 'newpassword2',
              'id'          => 'newpassword2',
              'class'       => 'span3',
              'size'        => '30'
            );
      $attr_input_conf = array(
              'name'        => 'confirmation',
              'id'          => 'confirmation',
              'class'       => 'span3',
              'size'        => '30'
            );            
  ?>
  <?php echo form_open('account/settings', $attr_form); ?>
  <div class="row">
  	<div class="span6">
	  <legend>General</legend>
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
	  <fieldset class="control-group">
	          <label for="disabledInput" class="control-label">Role</label>
	          <div class="controls">
	            <input type="text" disabled="" placeholder="<?php echo isset($settings->username) ? $settings->role : ''; ?>" name="role" class="span3 disabled">
	          </div>
	  </fieldset>
	</div>
	  
	  <div class="span6">
		  <legend>Change Password</legend>
		  <fieldset class="control-group<?php if(form_error('newpassword')) echo ' error'; ?>">
		          <label for="newpassword" class="control-label">New Password</label>
		          <div class="controls">
			        <?php echo form_password($attr_input_pwd); ?>
		        	<?php echo form_error('newpassword','<p class="help-block">','</p>'); ?>
		          </div>
		  </fieldset>
		  <fieldset class="control-group<?php if(form_error('newpassword2')) echo ' error'; ?>">
		          <label for="newpassword2" class="control-label">Confirm Password</label>
		          <div class="controls">
			        <?php echo form_password($attr_input_pwd2); ?>
		        	<?php echo form_error('newpassword2','<p class="help-block">','</p>'); ?>
		          </div>
		  </fieldset>	  	  	  
	  </div>
  </div> 
  <div class="row">
	  <div class="span12">
	  	  <legend>Confirm Changes</legend>
		  <fieldset class="control-group<?php if( isset($confirmation_error) ) echo ' error'; ?>">
		          <label for="newpassword" class="control-label">Your Password</label>
		          <div class="controls">
			        <?php echo form_password($attr_input_conf); ?>
		        	<span class="help-inline">Enter your current password to confirm changes.</span>
		          </div>
		  </fieldset>	  	
	  </div> 
  </div>
  <div class="row">
	  <div class="span12">  
		<fieldset class="form-actions">
	      <button class="btn large primary" type="submit">Save changes</button>
	      <button class="btn large" type="reset">Cancel</button>
		</fieldset>
	  </div> 
  </div>	   	  		   
	<?php echo form_close(); ?>
  
</div>