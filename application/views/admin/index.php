<h1 class="page-header">Administration <small>Beeing important.</small></h1>
<div class="row">
  <aside class="span4">
    <?php echo anchor('admin/users', 'Manage Users'); ?>
  </aside>
  <div class="span12">
    <h3>There are new Registrarions <small> Displaying 5 of <?php echo $count; ?></small></h3>
    <?php echo $table_users; ?>
    <div class="btn-toolbar">
      <div class="btn-group">
        <a href="#" class="btn">1</a>
        <a href="#" class="btn">2</a>
        <a href="#" class="btn">3</a>
        <a href="#" class="btn">4</a>
        <a href="#" class="btn">5</a>
      </div>
      <div class="btn-group">
        <a href="#" class="btn">6</a>
        <a href="#" class="btn">7</a>
        <a href="#" class="btn">8</a>
      </div>
      <div class="btn-group">
        <a href="#" class="btn">9</a>
      </div>
      <div class="btn-group">
        <a href="#" class="btn">10</a>
      </div>
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