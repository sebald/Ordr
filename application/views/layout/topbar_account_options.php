<ul class="nav secondary-nav">
  <li class="vertical-divider"></li>
  <?php if ($this->session->userdata('role') == 'admin' ) : ?>
  <li><?php echo anchor('admin', 'Admin'); ?></li>
  <?php endif; ?>  
  <li class="dropdown">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Account <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><?php echo anchor('account/settings', 'Settings'); ?></li>
      <li><a href="#">Help</a></li>
      <li class="divider"></li>
      <li><?php echo anchor('account/logout', 'Logout'); ?></li>
    </ul>
  </li>
</ul>