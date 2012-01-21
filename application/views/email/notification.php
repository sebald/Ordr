<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  	<title>ordr Notification</title>
  	<link href='http://fonts.googleapis.com/css?family=Anton&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  	<link rel="stylesheet" href="<?php echo base_url(); ?>css/email.css" type="text/css" media="screen" />
</head>
<body>
  	<h1>Hi there!</h1>
  	<p>
  		Your purchase of the following item  
	  	<?php if ( $status == 'ordered' ) : ?>
			has <u>been orderd</u>.
		<?php else : ?>
			has <u>arrived</u>.
		<?php endif; ?>
		<strong><?php echo $item; ?></strong>
	</p>
	<p>
		If you want to check details about the purchase go here: <a href="<?php echo $link ?>"><?php echo $link ?></a>
	</p>
	<p>
		
	</p>
	<p class="signature">
		Regards,
		<br/>
		<span class="brand">ordr</span>
	</p>
	<p class="footprint">
		<small>Please don't respont to this email! This is an automatically generated notification by the system.</small>
		<a href="http://distractedbysquirrels.com/" target="_blank" title="This software was written by Sebastian Sebald." class="icon-dbs"></a>
	</p>
</body>
</html>