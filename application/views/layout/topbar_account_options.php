<ul class="nav secondary-nav">
  <li class="dropdown">
    <a class="dropdown-toggle" href="#">Account</a>
    <ul class="dropdown-menu">
      <li><?php echo anchor('account/settings', 'Settings'); ?></li>
      <li><a href="#">Help</a></li>
      <li class="divider"></li>
      <li><?php echo anchor('account/logout', 'Logout'); ?></li>
    </ul>
  </li>
</ul>