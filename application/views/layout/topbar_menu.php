<?php
  $menu = array( 'orders' );
?>
<ul class="nav">
  <?php if ( $this->session->userdata('logged_in') ) : ?>
    <?php foreach($menu as $item): ?>
    	<li <?php echo $this->uri->segment(1) == $item ? 'class="active"' : '';?>><?php echo anchor($item, ucfirst($item)); ?></li>
    <?php endforeach; ?>
    <?php if ( $this->session->userdata('role') == 'admin') : ?>
    	<li <?php echo $this->uri->segment(1) == 'admin' ? 'class="active"' : '';?>><?php echo anchor('admin', 'Admin'); ?></li>
    <?php endif; ?>	
  <?php else : ?>
    <li <?php echo uri_string() == 'account/register' ? 'class="active"' : '';?>><?php echo anchor('account/register', 'Register'); ?></li>
    <li><?php echo anchor(base_url(), 'About'); ?></li>
  <?php endif; ?>
</ul>