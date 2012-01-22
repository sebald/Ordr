<?php echo form_open('account/login', 'class="form-horizontal""'); ?>
	<fieldset class="control-group">
          <label for="input01" class="control-label">Username</label>
          <div class="controls">
            <input type="text" name="username" value="<?php echo $this->session->flashdata('username') ?>" class="span3" size="30">
          </div>
    </fieldset>
	<fieldset class="control-group">
          <label for="password" class="control-label">Password</label>
          <div class="controls">
            <input type="password" name="password" class="span3" size="30">
          </div>
    </fieldset> 
    <fieldset class="form-actions">
      <button class="btn primary large" type="submit">Log in</button>
    </fieldset>
<?php echo form_close(); ?>
