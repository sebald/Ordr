<div class="container-fluid">
		<div class="page-controls">
						
			<h1>Place an Order</h1>
			
		</div>
		<div class="row">
			<div class="span10">		
				
				<div class="alert alert-block alert-info">
		        	<h3 class="alert-heading">You can choose from a number of options to place a new order.</h3>
					<ol>
				        <li>Place a custom order (empty, not prepopulated order form)</li>
				        <li>Use the search field to find a consumable and use a prepopulated order form.</li>
				        <li>Choose one of the consumables from a list to use a prepopulated order form.</li>
					</ol>
		      	</div>			

				<div class="bordered">
					<?php echo form_open('orders/autocomplete', 'class="form-inline right" autocomplete="off"', (isset($filter['display'])) ? array( 'display' => $query_display ) : ''); ?>
							<input type="search" data-provide="typeahead" data-source='<?php echo convert_for_typeahead($common_consumables); ?>' placeholder="Search Consumables" size="50" name="search">
							<button class="btn" type="submit" name="search_consumable">Create Order</button>
					<?php echo form_close(); ?>
					<a class="btn" href="<?php echo base_url(); ?>orders/new/">Place a custom order</a>						
				</div>

				
				<div id="common-consumables-accordion" class="accordion">
					<?php foreach ($categories as $category => $consumables) : ?>
					<div class="accordion-group">
		            	<div class="accordion-heading">
		                	<a href="#<?php echo $category ?>" data-parent="#common-consumables-accordion" data-toggle="collapse">
		                  		<?php echo $category ?>
		                	</a>
		            	</div>
		            	<div class="accordion-body collapse" id="<?php echo $category ?>">
		            		<div class="accordion-inner">
		            			<ul class="unstyled">
		            			<?php foreach ($consumables as $consumable) : ?>
									<li><?php echo anchor( 'orders/autocomplete_order/'.$consumable->id.'/id/' , $consumable->CAS_description); ?> <span>(<?php echo $consumable->package_size; ?>)</span></li>
								<?php endforeach; ?>
								</ul>
		            		</div>
		            	</div>						

					</div>
					<?php endforeach; ?>			
				</div>
				
			</div>
		</div>
</div>
