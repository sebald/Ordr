  </div>
  <footer>
    <p>Created by <a href="http://www.distractedbysquirrels.com">Sebastian Sebald</a></p>
  </footer>
</div>
<script src="<?php echo base_url();?>js/jquery.js"></script>
<script src="<?php echo base_url();?>js/bootstrap-transition.js"></script>
<script src="<?php echo base_url();?>js/bootstrap-dropdown.js"></script>
<script src="<?php echo base_url();?>js/bootstrap-modal.js"></script>
<script src="<?php echo base_url();?>js/bootstrap-alerts.js"></script>
<script src="<?php echo base_url();?>js/functions.js"></script>
<div class="modal hide fade" id="modal-user">
            <div class="modal-header">
              <a data-dismiss="modal" class="close" href="#">×</a>
              <h3>Account</h3>
            </div>
            <div class="modal-body">
				<ul class="unstyled">
			    	<li class="option"><?php echo anchor('account/settings', 'Settings'); ?> - Change your account information and settings.</li>
			  	</ul>
            </div>
            <div class="modal-footer">
            	<?php echo anchor('account/logout', 'Log out','class="btn large danger"'); ?>
            </div>
</div>
<body>
</html>