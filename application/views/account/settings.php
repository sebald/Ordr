<h1 class="page-header">Account Settings <small>Update your information.</small></h1>
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
              'name'        => 'password',
              'id'          => 'password',
              'class'       => 'span4',
              'size'        => '30'
            );
      $attr_input_pwd2 = array(
              'name'        => 'password2',
              'id'          => 'password2',
              'class'       => 'span4',
              'size'        => '30'
            );       
  ?>
  <?php echo form_open('account/register', $attr_form); ?>
    <div class="clearfix">
      <label>Username</label>
        <div class="input">
          <input id="username" type="text" disabled="" size="30" name="disabledInput" id="disabledInput" class="span4 disabled">
        </div>
    </div>
    <div class="clearfix">
      <label>First Name</label>
        <div class="input">
          <input id="username" type="text" disabled="" size="30" name="disabledInput" id="disabledInput" class="span4 disabled">
        </div>
    </div>
    <div class="clearfix">
      <label>Last Name</label>
        <div class="input">
          <input id="username" type="text" disabled="" size="30" name="disabledInput" id="disabledInput" class="span4 disabled">
        </div>
    </div>  
    <div class="clearfix <?php if(form_error('email')) echo 'error'; ?>">
      <?php echo form_label('Email:', 'email'); ?>
      <div class="input">
          <?php echo form_input($attr_input_email, set_value('email')); ?>
          <?php echo form_error('email','<span class="help-inline">','</span>'); ?>
      </div>
    </div>
    <div class="clearfix <?php if(form_error('password')) echo 'error'; ?>">
      <?php echo form_label('Password:', 'password'); ?>
      <div class="input">
          <?php echo form_password($attr_input_pwd); ?>
          <?php echo form_error('password','<span class="help-inline">','</span>'); ?>
      </div>
    </div>
    <div class="clearfix <?php if(form_error('password2')) echo 'error'; ?>">
      <?php echo form_label('Password confirm:', 'password2'); ?>
      <div class="input">
          <?php echo form_password($attr_input_pwd2); ?>
          <?php echo form_error('password2','<span class="help-inline">','</span>'); ?>
      </div>
    </div>
    <div class="clearfix">
      <label>Role</label>
        <div class="input">
          <input id="role" type="text" disabled="" size="30" name="disabledInput" id="disabledInput" class="span3 disabled">
        </div>
    </div>
    <div class="actions">
            <input type="submit" value="Save changes" class="btn primary">&nbsp;<button class="btn" type="reset">Cancel</button>
          </div>    
  <?php echo form_close(); ?>
  </div>
  <div class="span5">
    <h3>Notice:</h3>
    <p>Right now your are only allowed to change your email address and your password. Every other setting is fixed by the time you registered or can only be changed by an admin.</p>
  </div>
</div>