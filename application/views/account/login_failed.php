<div class="container">
	<div class="row">
		<div class="span6 offset3">
			<h1>Log in</h1>
			<?php echo $this->session->flashdata('message'); ?>
		</div>
	</div>
	<div class="row">
		<div class="span6 offset3">
			<?php $this->load->view('forms/form_login'); ?>	
		</div>
	</div>
</div>
