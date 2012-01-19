	<legend>Item Information</legend>
	<fieldset class="control-group<?php if(form_error('CAS_description')) echo ' error'; ?>">
      <label for="CAS_description" class="control-label">CAS / Description</label>
      <div class="controls">
        <input type="text" name="CAS_description" class="span4" value="<?php echo set_value('CAS_description', isset($order->CAS_description) ? $order->CAS_description : ''); ?>">
        <?php echo form_error('CAS_description','<p class="help-block">','</p>'); ?>
      </div>
    </fieldset>
    <fieldset class="control-group<?php if(form_error('category')) echo ' error'; ?>">
      <label for="category" class="control-label">Category</label>
      <div class="controls">
        <select name="category" class="span2">
			<?php foreach (get_consumable_categories() as $c) { ?>
				<option<?php echo (isset($order->category) && (@$order->category == $c) ) ? ' selected="selected"' : ''; ?>><?php echo $c; ?></option>
			<?php } ?>
        </select>
        <?php echo form_error('category','<span class="help-inline">','</span>'); ?>
      </div>
    </fieldset>
    <fieldset class="control-group<?php if(form_error('vendor')) echo ' error'; ?>">
      <label for="vendor" class="control-label">Vendor</label>
      <div class="controls">
        <input type="text" name="vendor" class="span2" value="<?php echo set_value('vendor', isset($order->vendor) ? $order->vendor : ''); ?>">
        <?php echo form_error('vendor','<span class="help-inline">','</span>'); ?>
      </div>				          			          
    </fieldset>    
    <fieldset class="control-group<?php if(form_error('catalog_number')) echo ' error'; ?>">
      <label for="catalog_number" class="control-label">Catalog Number</label>
      <div class="controls">
        <input type="text" name="catalog_number" class="span2" value="<?php echo set_value('catalog_number', isset($order->catalog_number) ? $order->catalog_number : ''); ?>">
        <?php echo form_error('catalog_number','<span class="help-inline">','</span>'); ?>
      </div>
    </fieldset>
    <fieldset class="control-group<?php if(form_error('package_size')) echo ' error'; ?>">
      <label for="package_size" class="control-label">Package Size</label>
      <div class="controls">
        <input type="text" name="package_size" class="span2" value="<?php echo set_value('package_size', isset($order->package_size) ? $order->package_size : ''); ?>">
        <?php echo form_error('package_size','<span class="help-inline">','</span>'); ?>
      </div>				          			          
    </fieldset>
	<legend>Pricing</legend>
	<fieldset class="control-group<?php if(form_error('price_unit')) echo ' error'; ?>">
      <label for="price_unit" class="control-label">Unit Price</label>
      <div class="controls">
        <input type="text" name="price_unit" class="span2" value="<?php echo set_value('price_unit', isset($order->price_unit) ? $order->price_unit : ''); ?>">
        <input type="text" name="currency" class="span1" value="<?php echo set_value('currency', isset($order->currency) ? $order->currency : 'EUR'); ?>" data-provide="typeahead" data-data='<?php echo convert_for_typeahead(get_currencies()); ?>'>
        <?php echo form_error('price_unit','<span class="help-inline">','</span>'); ?>
      </div>
    </fieldset>
    <fieldset class="control-group<?php if(form_error('quantity')) echo ' error'; ?>">
      <label for="quantity" class="control-label">Quantity</label>
      <div class="controls">
        <input type="text" name="quantity" class="span2" value="<?php echo set_value('quantity', isset($order->quantity) ? $order->quantity : '1'); ?>">
        <?php echo form_error('quantity','<span class="help-inline">','</span>'); ?>
      </div>
    </fieldset>
	<fieldset class="control-group">
      <label for="price_total" class="control-label">Total Price</label>
      <div class="controls">
      	<input type="text" disabled="" placeholder="0.0" name="price_total_disabled" class="span2 disabled">
      	<input type="text" disabled="" placeholder="<?php echo set_value('currency', isset($order->currency) ? $order->currency : 'EUR'); ?>" name="currency_disabled" class="span1 disabled">
      </div>
	</fieldset>
	<legend>Optional Information</legend>
    <fieldset class="control-group<?php if(form_error('account')) echo ' error'; ?>">
      <label for="account" class="control-label">Account</label>
      <div class="controls">
        <input type="text" name="account" class="span4" value="<?php echo set_value('account', isset($order->account) ? $order->account : ''); ?>">
        <?php echo form_error('account','<p class="help-block">','</p>'); ?>
      </div>
    </fieldset>
	<fieldset class="control-group<?php if(form_error('comment')) echo ' error'; ?>">
      <label for="input01" class="control-label">Comment</label>
      <div class="controls">
        <textarea rows="3" id="textarea" name="comment" class="span4"><?php echo set_value('price_unit', isset($order->comment) ? $order->comment : ''); ?></textarea>
        <?php echo form_error('comment','<p class="help-block">','</p>'); ?>
      </div>
    </fieldset>
	<fieldset class="form-actions">
    	<button type="submit" class="btn large primary"><?php echo ($mode == 'edit') ? 'Edit' : 'Place'; ?> Order</button>
    	<a href="<?php echo base_url();?>orders/" type="reset" class="btn large">Cancel</a>
	</fieldset>