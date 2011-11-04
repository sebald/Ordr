<h1 class="page-header">Account Settings <small>Update your information.</small></h1>
<?php if ( isset($error) ) : ?>
<div class="alert-message block-message error">
  <p><strong>Oh snap! There was an problem with displaying your settings.</strong> Please try again.</p>
</div>
<?php endif; ?>
<div class="row">
  <div class="span11">
  <?php
      $attr_form = array(
              'class'       => 'settings'
            );
      $attr_input_email = array(
              'name'        => 'email',
              'id'          => 'email',
              'class'       => 'span4',
              'size'        => '30',
              'type'        => 'email',
              'pattern'     => '[^ @]*@[^ @]*'
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
    <div class="clearfix">
      <label>Role</label>
        <div class="input">
          <input id="role" type="text" disabled="" size="30" name="role" id="disabledInput" class="span3 disabled" value="<?php echo isset($settings->role) ? $settings->role : ''; ?>">
        </div>
    </div>
  </fieldset>
  <fieldset>
    <legend>Change Password</legend>
    <div class="clearfix <?php if(form_error('newpassword')) echo 'error'; ?>">
    <?php echo form_label('New Password:', 'newpassword'); ?>
    <div class="input">
        <?php echo form_password($attr_input_pwd); ?>
        <?php echo form_error('newpassword','<span class="help-inline">','</span>'); ?>
    </div>
    </div>
    <div class="clearfix <?php if(form_error('newpassword2')) echo 'error'; ?>">
      <?php echo form_label('Password confirm:', 'newpassword2'); ?>
      <div class="input">
          <?php echo form_password($attr_input_pwd2); ?>
          <?php echo form_error('newpassword2','<span class="help-inline">','</span>'); ?>
      </div>
    </div>
  </fieldset>
  <fieldset> 
    <div class="clearfix <?php if( isset($confirmation_error) ) echo 'error'; ?>">
      <?php echo form_label('Confirmation:', 'confirmation'); ?>
      <div class="input">
          <?php echo form_password($attr_input_conf); ?>
          <span class="help-inline">Enter your old password to confirm changes.</span>
      </div>
    </div>
  <fieldset>  
  <div class="actions">
    <input type="submit" value="Save changes" class="btn primary">&nbsp;<button class="btn" type="reset">Cancel</button>
  </div>    
  <?php echo form_close(); ?>
  </div>
  <div class="span5 ">
    <div class="alert-message block-message warning">
    <strong>Notice:</strong>
    Right now your are only allowed to change your email address and your password. Every other setting is fixed by the time you registered or can only be changed by an admin.
    </div>
  </div>
</div>