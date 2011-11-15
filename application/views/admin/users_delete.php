<h1 class="page-header">Delete User(s) <small>Deletion is permantly, btw!</small></h1>
<?php echo form_open('admin/users/delete',''); ?>
	<h3>The following users will be deleted:</h3>
	<?php echo $table_users; ?>
	<div class="center">
    	<input name="submit-delete" type="submit" value="Delete" class="btn danger">&nbsp;<a class="btn" type="reset" href="<?php echo $_SERVER['HTTP_REFERER']; ?>" >Cancel</a>
	</div>
<?php echo form_close(); ?>
