<div class="fluid-container">
	<div class="fluid-content">
		
		<div class="page-controls">
			<h1>Edit Consumable</h1>
		</div>
		
		<div class="row">
			<div class="span8">
				
				<?php echo $this->session->flashdata('message'); ?>
				
				<?php $data['mode'] = 'edit'; ?>
				<?php $data['action'] = 'admin/consumables/edit/'; ?>
				<?php $data['consumable'] = $consumable;?>
				<?php $this->load->view('forms/form_consumable', $data); ?>
				
			</div>
		</div>
	</div>
</div>
<?php print_a($_POST); ?>