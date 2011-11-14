<h1 class="page-header">Account Settings for <?php echo $settings->username; ?> <small>Update User Information.</small></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <?php
      $attr_form = array(
              'class'       => 'settings'
            );
      $attr_input_email = array(
              'name'        => 'email',
              'id'          => 'email',
              'class'       => 'span4',
              'size'        => '30'
            );
      $attr_input_role = 'id="role" class="span3"';			       
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
	  $options_role = array (
	  		  'inactive' => 'inactive',
	  		  'user' => 'User',
	  		  'purchaser' => 'Purchaser',
	  		  'admin' => 'Admin'
  		    );           
  ?>
  <?php echo form_open('admin/users/edit/'.$settings->username, $attr_form); ?>
  <fieldset>
    <legend>General</legend>
    <div class="clearfix">
      <label>Username</label>
        <div class="input">
          <input id="username" type="text" disabled="" size="30" name="username" id="disabledInput" class="span4 disabled" value="<?php echo isset($settings->username) ? $settings->username : ''; ?>">
        </div>
    </div>
    <div class="clearfix">
      <label>First Name</label>
        <div class="input">
          <input id="username" type="text" disabled="" size="30" name="first_name" id="disabledInput" class="span4 disabled" value="<?php echo isset($settings->first_name) ? $settings->first_name : ''; ?>">
        </div>
    </div>
    <div class="clearfix">
      <label>Last Name</label>
        <div class="input">
          <input id="username" type="text" disabled="" size="30" name="last_name" id="disabledInput" class="span4 disabled" value="<?php echo isset($settings->last_name) ? $settings->last_name : ''; ?>">
        </div>
    </div>  
    <div class="clearfix <?php if(form_error('email')) echo 'error'; ?>">
      <?php echo form_label('Email:', 'email'); ?>
      <div class="input">
          <?php echo form_input($attr_input_email, set_value('email', isset($settings->email) ? $settings->email : '')); ?>
          <?php echo form_error('email','<span class="help-inline">','</span>'); ?>
      </div>
    </div>
    <div class="clearfix <?php if(form_error('role')) echo 'error'; ?>">
      <?php echo form_label('Role:', 'role'); ?>
      <div class="input">
      	  <?php echo form_dropdown('role', $options_role, $settings->role, $attr_input_role); ?>
          <?php echo form_error('role','<span class="help-inline">','</span>'); ?>
      </div>
    </div>
  </fieldset>
  <div class="actions">
    <input type="submit" value="Save changes" class="btn primary">&nbsp;<a class="btn" type="reset" href="<?php echo ($this->session->flashdata('referer')) ? $this->session->flashdata('referer') : $_SERVER['HTTP_REFERER']; ?>">Cancel</a>
  </div>    
  <?php echo form_close(); ?>