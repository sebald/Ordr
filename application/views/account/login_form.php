<h1 class="page-header">Login <small>Already registered? Login!</small></h1>
<?php
    $attr_form = array(
            'class'        => 'login'
          );
    $attr_input_username = array(
            'name'        => 'username',
            'id'          => 'username',
            'class'       => 'span3',
            'size'        => '30'
          );
    $attr_input_pwd = array(
            'name'        => 'password',
            'id'          => 'password',
            'class'       => 'span3',
            'size'        => '30'
          );
?>

<?php echo form_open('account/login', $attr_form); ?>
<div class="clearfix">
  <?php echo form_label('Username: ', 'username'); ?>
  <div class="input">
    <?php
      echo form_input($attr_input_username);
    ?>
  </div>
</div>
<div class="clearfix">
  <?php echo form_label('Password:', 'password'); ?>
  <div class="input">
    <?php
      echo form_password($attr_input_pwd);
    ?>
  </div>
</div>
<div class="actions">
  <?php echo form_submit('login', 'Log in', 'class="btn primary"'); ?>
</div>
<?php echo form_close(); ?>

<?php echo validation_errors(); ?>