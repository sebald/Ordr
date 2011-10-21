<!DOCTYPE html>
<html lang="en">  
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  
  <title>Ordr</title>
	
	<link href='http://fonts.googleapis.com/css?family=Luckiest+Guy' rel='stylesheet' type='text/css'>	
  
	<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css" type="text/css" media="screen">
  <link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen" />
	
</head>  
<body>
<header class="topbar">
  <div class="fill">
    <div class="container">
      <a href="#" class="brand">Ordr</a>
      <ul class="nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
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