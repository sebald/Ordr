<h1 class="page-header">Administration <small>Beeing important.</small></h1>
<div class="row">
  <aside class="span4">
    <ul class="unstyled">
      <li><h4><?php echo anchor('admin/users', 'Manage Users', 'id="manage-users"'); ?></h4></li>
      <li><h4><?php echo anchor('admin/users', 'Manage Users'); ?></h4></li>
      <li><h4><?php echo anchor('admin/users', 'Manage Users'); ?></h4></li>
    </ul>
  </aside>
  <div class="span12">
    <h3>There are new Registrations <small> Displaying 5 of <?php echo $count; ?></small></h3>
    <?php echo $table_users; ?>
    <div class="table-actions">
        <a class="btn-flat" href="<?php echo base_url(); ?>admin/users/role=inactive/username/asc/0/"><span class="list"></span>Show all</a>
    </div>
  </div>
</div>

<?php

function print_a(){
	$numargs = func_num_args();
	if($numargs>1){
		$out = '';
		ob_start();
		echo "<div style='background-color:#FFCC33;border:1px solid black;margin:3px;padding:5px;'>";
		for($a=0;$a<$numargs;$a++)
		print_a(func_get_arg($a));
		echo "</div>";
		$out .= ob_get_contents();
		ob_end_clean();
		echo $out;
	}else{
		echo "<pre style='background-color:#FFDF80;border:1px solid #000;margin:3px;padding:5px;'>";
		$a = func_get_arg(0);
		$a = (is_bool($a))?(($a)?'true':'false'):$a;
		print_r($a);
		echo "</pre>";
	}
}

?>