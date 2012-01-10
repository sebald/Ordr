<!DOCTYPE html>
<html lang="en">  
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  
  <?php
    $c = ucfirst($this->router->class);
    $f = $this->router->method != 'index' ? '| '.ucfirst($this->router->method) : '';
  ?>
  <title>Ordr | <? echo $c ?> <? echo $f; ?></title>
	
	<link href='http://fonts.googleapis.com/css?family=Anton&subset=latin,latin-ext' rel='stylesheet' type='text/css'>	
  
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css" type="text/css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" media="screen" />
	
</head>  
<body>
<header class="navbar navbar-fixed">
      <div class="navbar-inner">
        <div class="fluid-container">
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
<div class="content">