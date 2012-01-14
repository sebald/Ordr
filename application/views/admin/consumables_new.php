<div class="fluid-container">
	<div class="fluid-content">
		
		<div class="page-header">
			<h1>Consumables</h1>
		</div>
		
		<div class="row">
			<div class="span8">
				<?php echo $this->session->flashdata('message'); ?>
				
				<?php echo form_open('admin/consumables/new', 'class="horizontal-form"'); ?>
					<legend>Item Information</legend>
					<fieldset class="control-group<?php if(form_error('CAS_description')) echo ' error'; ?>">
			          <label for="CAS_description" class="control-label">CAS / Description</label>
			          <div class="controls">
			            <input type="text" name="CAS_description" class="span4">
			            <?php echo form_error('CAS_description','<span class="help-inline">','</span>'); ?>
			          </div>
			        </fieldset>
			        <fieldset class="control-group<?php if(form_error('category')) echo ' error'; ?>">
			          <label for="category" class="control-label">Category</label>
			          <div class="controls">
			            <select name="category" class="span2">
			            	<?php foreach ($consumable_categories as $c) { ?>
								<option><?php echo $c; ?></option>
							<?php } ?>
			            </select>
			            <?php echo form_error('category','<span class="help-inline">','</span>'); ?>
			          </div>
			        </fieldset>			        
			        <fieldset class="control-group<?php if(form_error('catalog_number')) echo ' error'; ?>">
			          <label for="catalog_number" class="control-label">Catalog Number</label>
			          <div class="controls">
			            <input type="text" name="catalog_number" class="span3">
			            <?php echo form_error('catalog_number','<span class="help-inline">','</span>'); ?>
			          </div>
			        </fieldset>
			        <fieldset class="control-group<?php if(form_error('vendor')) echo ' error'; ?>">
			          <label for="vendor" class="control-label">Vendor</label>
			          <div class="controls">
			            <input type="text" name="vendor" class="span3">
			            <?php echo form_error('vendor','<span class="help-inline">','</span>'); ?>
			          </div>				          			          
			        </fieldset>
			        <fieldset class="control-group<?php if(form_error('package_size')) echo ' error'; ?>">
			          <label for="package_size" class="control-label">Package Size</label>
			          <div class="controls">
			            <input type="text" name="package_size" class="span2">
			            <?php echo form_error('package_size','<span class="help-inline">','</span>'); ?>
			          </div>				          			          
			        </fieldset>
					<legend>Pricing</legend>
					<fieldset class="control-group<?php if(form_error('price_unit')) echo ' error'; ?>">
			          <label for="price_unit" class="control-label">Unit Price</label>
			          <div class="controls">
			            <input type="text" name="price_unit" class="span2">
			            <input type="text" name="currency" class="span1" value="EUR" data-provide="typeahead" data-data='<?php echo $currencies; ?>'>
			            <?php echo form_error('price_unit','<span class="help-inline">','</span>'); ?>
			          </div>
			        </fieldset>
					<legend>Optional Information</legend>
					<fieldset class="control-group<?php if(form_error('comment')) echo ' error'; ?>">
			          <label for="comment" class="control-label">Comment</label>
			          <div class="controls">
			            <textarea rows="3" id="textarea" name="comment" class="span4"></textarea>
			            <?php echo form_error('comment','<p class="help-block">','</p>'); ?>
			          </div>
			        </fieldset>
					<fieldset class="form-actions">
				    	<button type="submit" class="btn large primary">Create Consumable</button>
				    	<button type="reset" class="btn large">Cancel</button>
					</fieldset>      					        
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>