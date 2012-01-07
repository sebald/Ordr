<?php
    $attr_form = array(           
            'class'        => 'navbar-form pull-right'
          );
    echo form_open('account/login', $attr_form);
?>
  <input type="hidden" name="redirect" value="<?php echo current_url(); ?>" />
  <input name="username" type="text" placeholder="Username" class="input-small">
  <input name="password" type="password" placeholder="Password" class="input-small">
  <button type="submit" class="btn">Log in</button>
<?php echo form_close(); ?>