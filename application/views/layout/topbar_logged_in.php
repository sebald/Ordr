<ul class="nav pull-right">
	<li class="dropdown" id="user-options">
		<a data-toggle="dropdown" class="dropdown-toggle" href="#">Logged in as <span class="user-name"><?php echo $this->session->userdata('username'); ?></span></a>
		<ul class="dropdown-menu">
		  <li><?php echo anchor('account/settings', 'Settings'); ?></li>
		  <li><a href="#">Help</a></li>
		  <li><a href="https://github.com/sebald/Ordr/issues">Submit an Issue</a></li>
		  <li class="divider"></li>
		  <li><?php echo anchor('account/logout', 'Log out'); ?></li>
		</ul>
	</li>               
</ul>