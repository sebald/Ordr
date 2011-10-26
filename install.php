<h1>Installer</h1>
<?php
DEFINE('DS', DIRECTORY_SEPARATOR);
DEFINE('BASEPATH', '');

$c_dir    = 'application' .DS. 'controllers' .DS;
$core_dir = 'application' .DS. 'core' .DS;
$s_dir    = 'system' .DS. 'core' .DS;

require_once($s_dir.'Controller.php');
require_once($core_dir.'MY_Controller.php');

$files = scandir($c_dir);
$acl = array();
$acl['admin'] = array();
$acl['user'] = array();
$acl['visitor'] = array();

$fn = 'acl.php';
$fh = fopen($fn, 'a+') or die('can\'t open file');

foreach( $files as $file ) {
  $piece = explode(".", $file);
  if( $piece[0] != '' && $piece[1] == 'php' ) {
    $controller = $piece[0];
    
    foreach ( array_keys($acl) as $role ) {
      $acl[$role][$controller] = array();
    }
    
    require_once($c_dir.$file);
    $methods = get_class_methods($controller);
    foreach ( array_keys($acl) as $role ) {
      foreach ( $methods as $k => $method ) {
        if ( $method == 'get_instance' || $method == '__construct' )
          continue;
        $acl[$role][$controller][$method] = 'FALSE';
        $data = '$acl['.$role.']['.$controller.']['.$method.'] = FALSE;';
        // fwrite($fh,$data."\n");
      }
    }
    
  }
}

// fwrite($fh, $acl);
fclose($fh);

print_a($acl);
// print_r($class_methods);

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