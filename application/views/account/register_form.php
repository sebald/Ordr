<h1 class="page-header">Create an account <small>Not a user? Oh god! Go sign up, now!</small></h1>
<?php
    $attr_form = array(
            'method'      => 'post',
            'class'       => 'register'
          );
    $attr_input_first_name = array(
            'name'        => 'first_name',
            'id'          => 'firstname',
            'class'       => 'large',
            'size'        => '30'
          );
    $attr_input_last_name = array(
            'name'        => 'last_name',
            'id'          => 'lastname',
            'class'       => 'large',
            'size'        => '30'
          );
    $attr_input_email = array(
            'name'        => 'email',
            'id'          => 'email',
            'class'       => 'large',
            'size'        => '30',
            'type'        => 'email',
            'pattern'     => '[^ @]*@[^ @]*'
          );            
    $attr_input_pwd = array(
            'name'        => 'password',
            'id'          => 'password',
            'class'       => 'large',
            'size'        => '30'
          );
    $attr_input_pwd2 = array(
            'name'        => 'password2',
            'id'          => 'password2',
            'class'       => 'large',
            'size'        => '30'
          );       
?>

<?php echo form_open('account/register', $attr_form); ?>
    <div class="clearfix">
      <label>Username</label>
        <div class="input">
          <input id="username" type="text" disabled="" size="30" name="disabledInput" id="disabledInput" class="large disabled">
          <span class="help-inline">This is automatically generated for you.</span>
        </div>
    </div>
    <div class="clearfix <?php if(form_error('first_name')) echo 'error'; ?>">
      <?php echo form_label('First name:', 'first_name'); ?>
      <div class="input">
          <?php echo form_input($attr_input_first_name, set_value('first_name')); ?>
          <?php echo form_error('first_name','<span class="help-inline">','</span>'); ?>
      </div>
    </div>
    <div class="clearfix <?php if(form_error('last_name')) echo 'error'; ?>">
      <?php echo form_label('Last name:', 'last_name'); ?>
      <div class="input">
          <?php echo form_input($attr_input_last_name, set_value('last_name')); ?>
          <?php echo form_error('last_name','<span class="help-inline">','</span>'); ?>
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
    <div class="actions">
      <?php echo form_submit('register', 'Register', 'class="btn large primary"'); ?>
    </div>
<?php echo form_close(); ?>