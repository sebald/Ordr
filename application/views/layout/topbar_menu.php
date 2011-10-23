<?php
  $menu = array( 'orders' );
?>
<ul class="nav">
  <?php if ( $this->session->userdata('logged_in') ) : ?>
    <?php foreach($menu as $item): ?>
    <li><a href="<?php echo base_url().$item.'/'; ?>"><?php echo ucfirst($item); ?></a></li>
    <?php endforeach; ?>
  <?php else : ?>
    <li><a href="<?php echo base_url().'account/register/'; ?>">Register</a></li>
    <li><a href="http://example.com">About</a></li>
  <?php endif; ?>
</ul>