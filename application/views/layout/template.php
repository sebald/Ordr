<?php
	$data['controls'] = TRUE;
	if( isset($controls) && @$controls == FALSE )
		$data['controls'] = FALSE;
?>

<?php $this->load->view('layout/header', $data); ?>

<?php $this->load->view($main_content); ?>

<?php $this->load->view('layout/footer'); ?>