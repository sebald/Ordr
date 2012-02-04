<div class="container-fluid">
		
		<div class="page-controls">
			<h1>New Consumable</h1>
		</div>
		
		<div class="row">
			<div class="span8">
				<?php echo $this->session->flashdata('message'); ?>
				
				<?php $data['mode'] = 'new'; ?>
				<?php $data['action'] = 'admin/consumables/new'; ?>
				<?php $this->load->view('forms/form_consumable', $data); ?>
					
			</div>
		</div>
</div>