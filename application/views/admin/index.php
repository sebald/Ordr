<div class="fluid-container">
	<div class="page-controls">
		<h1>Overview</h1>
	</div>
	<?php if ( $new_users) : ?>
	<div class="row">
	  <div class="span12">
	  	<div class="alert alert-info">
	        <p><strong>New Registrations!</strong> There have been <?php echo $new_users; ?> new registrations that need your attention. Please take a look at them and confirm or reject the registration by setting the role accordingly. This message will disappear when all new registrations have been processed.</p>
	        <div class="alert-actions">
	          <a href="<?php echo base_url(); ?>admin/users/view/role=new/" class="btn info small">Show new Users</a>
	        </div>
      	</div>	    
	  </div>
	</div>
	<?php endif; ?>
	<div class="row admin-options">
		<a href="<?php echo base_url(); ?>admin/users/view/">
			<div class="span4 rounded-box">
				<div class="option user"></div>
				<h2>Mangage Users</h2>
			</div>
		</a>
		<a href="<?php echo base_url(); ?>admin/consumables/view/">
			<div class="span4 rounded-box">
				<div class="option shop"></div>
				<h2>Manage Consumables</h2>
			</div>
		</a>
	</div>
</div>