<!DOCTYPE html>
<html lang="en">  
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  
  <?php
    $c = ucfirst($this->router->class);
    $f = $this->router->method != 'index' ? '| '.ucfirst($this->router->method) : '';
  ?>
  <title>Ordr | <? echo $c ?> <? echo $f; ?></title>
	
	<link href='http://fonts.googleapis.com/css?family=Luckiest+Guy' rel='stylesheet' type='text/css'>	
  
	<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css" type="text/css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" media="screen" />
	
</head>  
<body>
<header class="topbar">
  <div class="fill">
    <div class="container">
      <a href="<?php echo base_url(); ?>" class="brand">Ordr</a>
      <?php $this->load->view('layout/topbar_menu'); ?>
      <?php
        if ( $this->session->userdata('logged_in') ){
          $this->load->view('layout/topbar_account_options');
        } else {
          $this->load->view('layout/topbar_login');
        }
      ?>
    </div>
  </div>
</header>
<div class="container">
  <div class="content">