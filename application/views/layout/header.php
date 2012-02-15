<!DOCTYPE html>
<html lang="en">  
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  
  	<?php
  		$page = '';
  		if ( $this->router->method != 'index' )
			$page = ' | ' . ucwords(str_replace('_', ' | ', $this->router->method));
		$title = ucfirst($this->router->class) . $page;
  	?>
  	<title>Ordr | <? echo $title ?></title>
	
	<link href="<?php echo base_url(); ?>img/favicon.ico" type="image/x-icon" rel="shortcut icon">
	
	<link href='http://fonts.googleapis.com/css?family=Anton&subset=latin,latin-ext' rel='stylesheet' type='text/css'>	
  
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.css" type="text/css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" media="screen" />
  <!--[if !IE 7]>
	<style type="text/css">
		#wrap {display:table;height:100%}
	</style>
	<![endif]-->
	
</head>  
<body class="<?php echo $this->router->class; ?> <?php echo $this->router->method; ?>">
<header class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a href="<?php echo base_url(); ?>" class="brand">ordr</a>
          <?php $this->load->view('layout/topbar_menu'); ?>
          <?php
	        if ( $this->session->userdata('logged_in') ){
	          $this->load->view('layout/topbar_logged_in');
	        } else {
	          $this->load->view('layout/topbar_login');
	        }
	      ?>
        </div>
      </div>
</header>
<div class="content<?php echo ($controls) ? ' controls' : ''; ?>">