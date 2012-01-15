<?php
	$attr_input_search = array(
          'name'        => 'search',
          'type'		=> 'search',
          'size'        => '30',
          'placeholder' => 'Search Consumables'
	);	
	$attr_submit_search = array(
		  'type'		=> 'submit',
          'class'       => 'autocomplete',
          'content'		=> 'Search'
	);
?>	
<div class="fluid-container">
	<div class="fluid-content">
		<div class="page-controls">
			
			<?php echo form_open('orders/search', 'class="search-form"', (isset($filter['display'])) ? array( 'display' => $query_display ) : ''); ?>
				<div class="input-append search">
					<?php echo form_input($attr_input_search, (isset($filter['search'])) ? $filter['search'] : ''); ?>
					<label class="add-on">
						<?php echo form_button($attr_submit_search); ?>
					</label>
			    </div>
			<?php echo form_close(); ?>	
			
			<h1>New Order</h1>
			
		</div>
		<div class="row">
			<div class="span8">
				<div class="alert-message block-message info">
			        <p><strong>Notice!</strong> If you want to order a common consumable use the <em>search on the right</em>. Maybe the consumable is already in the data base. If so, the order form will be filled out for you.</p>
			    </div>
				<form class="form-horizontal">
					<legend>Item Information</legend>
					<fieldset class="control-group">
			          <label for="input01" class="control-label">CAS / Description</label>
			          <div class="controls">
			            <input type="text" name="input01" class="span3">
			          </div>
			        </fieldset>
			        <fieldset class="control-group">
			          <label for="input01" class="control-label">Category</label>
			          <div class="controls">
			            <select name="category">
			              <option>Chemical</option>
			              <option>Equipment</option>
			              <option>Solvent</option>
			            </select>
			          </div>
			        </fieldset>
			        <fieldset class="control-group">
			          <label for="input01" class="control-label">Catalog Number</label>
			          <div class="controls">
			            <input type="text" name="input01" class="span3">
			          </div>
			        </fieldset>
			        <fieldset class="control-group">
			          <label for="input01" class="control-label">Vendor</label>
			          <div class="controls">
			            <input type="text" name="input01" class="span3">
			          </div>				          			          
			        </fieldset>
			        <fieldset class="control-group">
			          <label for="input01" class="control-label">Package Size</label>
			          <div class="controls">
			            <input type="text" name="input01" class="span2">
			          </div>				          			          
			        </fieldset>
					<legend>Pricing</legend>
					<fieldset class="control-group">
			          <label for="input01" class="control-label">Unit Price</label>
			          <div class="controls">
			            <input type="text" name="input01" class="span2">
			            <input type="text" name="input01" class="span1">
			          </div>
			        </fieldset>
			        <fieldset class="control-group">
			          <label for="input01" class="control-label">Quantity</label>
			          <div class="controls">
			            <input type="text" name="input01" class="span2">
			          </div>
			        </fieldset>
					<fieldset class="control-group">
			          <label for="disabledInput" class="control-label">Total Price</label>
			          <div class="controls">
			          	<input type="text" disabled="" placeholder="$$$$" name="disabledInput" id="disabledInput" class="span2 disabled">
			          </div>
        			</fieldset>
					<legend>Optional Information</legend>
			        <fieldset class="control-group">
			          <label for="input01" class="control-label">Account</label>
			          <div class="controls">
			            <input type="text" name="input01" class="span4">
			          </div>
			        </fieldset>
					<fieldset class="control-group">
			          <label for="input01" class="control-label">Comment</label>
			          <div class="controls">
			            <textarea rows="3" id="textarea" name="textarea" class="span4"></textarea>
			          </div>
			        </fieldset>
					<fieldset class="form-actions">
				    	<button type="submit" class="btn large primary">Create Order</button>
				    	<button type="reset" class="btn large">Cancel</button>
					</fieldset>      					        
				</form>
			</div>
		</div>
	</div>
</div>