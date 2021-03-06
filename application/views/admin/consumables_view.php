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

<div class="container-fluid">
<div class="row-fluid">
	
	<div class="span2">
		
		<div class="page-controls">
			<h1>Consumables</h1>
		</div>	
		
		<div class="well sidebar-nav">
			<ul class="nav nav-list">
				<li class="nav-header">Category</li>
				<li<?php echo empty($filter['category']) ? ' class="active"' : ''; ?>><?php echo anchor('admin/consumables/view/','All' ); ?></li>
				<?php foreach ($consumable_categories as $c) : ?>
					<li<?php echo @($filter['category'] == strtolower($c)) ? ' class="active"' : ''; ?>><?php echo anchor('admin/consumables/view/category='.strtolower($c).'/', $c ); ?></li>
				<?php endforeach;	?>
			</ul>
		</div>
		
	</div>
	
	<div class="span10">

		<div class="page-controls">		
			<div class="actions">
				<a href="<?php echo base_url();?>admin/consumables/new/" rel="tooltip" data-original-title="New" class="btn-flat single"><i class="add"></i></a> 
			</div>
		</div>	
		
		<?php echo $this->session->flashdata('message'); ?>
		
		<table class="table">
			
			  <thead>
			    <?php foreach( $fields as $field_name => $field_display): ?>
			    <th class="sortable blue header<?php if ($by == $field_name) echo ($order == 'asc') ? ' headerSortUp' : ' headerSortDown'; ?>">
			      <?php echo anchor("admin/consumables/view/$query/$field_name/" .
			        (($order == 'asc' && $by == $field_name) ? 'desc' : 'asc') ,
			        $field_display); ?>
			    </th>
			    <?php endforeach; ?>
			    <th>Actions</th>
			  </thead>
			  
			  <tbody>
			    <?php foreach($consumables as $consumable): ?>
			    <tr>
			      <?php foreach($fields as $field_name => $field_display): ?>
			      <td>
			        <?php echo $consumable->$field_name; ?>
			      </td>
			      <?php endforeach; ?>
			      <td>
			      	<?php echo anchor('admin/consumables/edit/'.$consumable->id, 'edit', 'class="action edit" title="Edit User"'); ?>
			      	<?php echo anchor('admin/consumables/delete/'.$consumable->id, 'delete', 'class="action delete" title="Delete User"'); ?>
			      </td>
			    </tr>
			    <?php endforeach; ?>			
			  </tbody>
				  
		</table>		
		
		<?php if (strlen($pagination)): ?>
		<div class="pagination pagination-centered">
		  <ul>
		    <?php echo $pagination; ?>
		  </ul>
		</div>
		<?php endif; ?>		
		
	</div>
	
</div>
</div>