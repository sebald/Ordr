<h1 class="page-header">Administration <small>Beeing important.</small></h1>
<div class="row">
  <aside class="span4">
    <ul class="unstyled">
      <li><h4><?php echo anchor('admin/users/view', 'Manage Users', 'id="manage-users"'); ?></h4></li>
      <li><h4><?php echo anchor('admin/users/view', 'Manage Users'); ?></h4></li>
      <li><h4><?php echo anchor('admin/users/view', 'Manage Users'); ?></h4></li>
    </ul>
  </aside>
  <div class="span12">
  	<?php if ( $table_users) : ?>
    <h3>There are new Registrations <small> Displaying <?php echo ($count <= 5) ? $count : '5'; ?> of <?php echo $count; ?></small></h3>
    <?php echo $table_users; ?>
    <div class="table-actions">
        <a class="btn-flat list" href="<?php echo base_url(); ?>admin/users/view/role=inactive/username/asc/0/"><span></span>Show all</a>
    </div>
    <?php endif; ?>
  </div>
</div>