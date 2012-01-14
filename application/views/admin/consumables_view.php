<?php
	$query_display 	= (isset($filter['display'])) ? implode('+',$filter['display']) : '';
	$keep_query = '';
	( isset($filter['search']) ) ? $keep_query['search'] = $filter['search'] : '' ;
	( isset($filter['role']) ) ? $keep_query['role'] = $filter['role'] : '' ;

	$attr_input_search = array(
          'name'        => 'search',
          'type'		=> 'search',
          'size'        => '30',
          'placeholder' => 'Search'
	);	
	$attr_submit_search = array(
		  'type'		=> 'submit',
          'class'       => 'search',
          'content'		=> 'Search',
          'name'		=> 'action',
          'value'		=> 'search'
	);
?>

<div class="fluid-container sidebar-left">
	
	<aside class="fluid-sidebar">
		
		<div class="page-header">
			<h1>Consumables</h1>
		</div>	
		
		
	</aside>
	
	<div class="fluid-content">

		<div class="page-header">		
			<div class="actions">
				<a href="<?php echo base_url();?>admin/consumables/new/" rel="twipsy" data-original-title="New" class="btn-flat single"><i class="shop"></i></a> 
			</div>
		</div>	
		
		<?php echo $this->session->flashdata('message'); ?>
		
	</div>
	
</div>