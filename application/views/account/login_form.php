<?php if ( isset($error) ) : ?>
<div class="alert-message block-message error">
  <p><strong>Oh snap! You entered the wrong unsername and/or password.</strong> Try the following:</p>
  <ul>
    <li>Retry the log in process with your credentials.</li>
    <li>Visit the help page.</li>
    <li>Contact an admin from your office.</li>
  </ul>
</div>
<?php endif; ?>
<?php if ( isset($permission_denied) ) : ?>
<div class="alert-message block-message warning">
  <p><strong>Warning! You don't have the permission to view this page.</strong> If you should have permission please contact an admin from your office.</p>
  <div class="alert-actions">
    <?php echo anchor('/', 'Go to start page.', 'class="btn small"'); ?>
  </div>
</div>
<?php endif; ?>
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
  <input type="hidden" name="redirect" value="<?php echo (isset($_POST['redirect']) ? $_POST['redirect'] : current_url() ); ?>" />
<div class="clearfix">
  <?php echo form_label('Username: ', 'username'); ?>
  <div class="input">
    <?php
      echo form_input($attr_input_username, set_value('username'));
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