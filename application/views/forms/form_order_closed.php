	<legend>Item Information</legend>
	<fieldset class="control-group<?php if(form_error('CAS_description')) echo ' error'; ?>">
      <label for="CAS_description" class="control-label">CAS / Description</label>
      <div class="controls">
        <input type="text" name="CAS_description" class="span4 disabled" disabled="" placeholder="<?php echo set_value('CAS_description', isset($order->CAS_description) ? $order->CAS_description : ''); ?>">
      </div>
    </fieldset>
    <fieldset class="control-group<?php if(form_error('category')) echo ' error'; ?>">
      <label for="category" class="control-label">Category</label>
      <div class="controls">
        <input type="text" name="category" class="span4 disabled" disabled="" placeholder="<?php echo set_value('CAS_description', isset($order->category) ? $order->category : ''); ?>">
      </div>
    </fieldset>
    <fieldset class="control-group<?php if(form_error('vendor')) echo ' error'; ?>">
      <label for="vendor" class="control-label">Vendor</label>
      <div class="controls">
        <input type="text" name="vendor" class="span2 disabled" disabled="" placeholder="<?php echo set_value('vendor', isset($order->vendor) ? $order->vendor : ''); ?>">
      </div>				          			          
    </fieldset>    
    <fieldset class="control-group<?php if(form_error('catalog_number')) echo ' error'; ?>">
      <label for="catalog_number" class="control-label">Catalog Number</label>
      <div class="controls">
        <input type="text" name="catalog_number" class="span2  disabled" disabled="" placeholder="<?php echo set_value('catalog_number', isset($order->catalog_number) ? $order->catalog_number : ''); ?>">
      </div>
    </fieldset>
    <fieldset class="control-group">
      <label for="package_size" class="control-label">Package Size</label>
      <div class="controls">
        <input type="text" name="package_size" class="span2  disabled" disabled="" placeholder="<?php echo set_value('package_size', isset($order->package_size) ? $order->package_size : ''); ?>">
      </div>				          			          
    </fieldset>
	<legend>Pricing</legend>
	<fieldset class="control-group">
      <label for="price_unit" class="control-label">Unit Price</label>
      <div class="controls">
        <input type="text" name="price_unit" class="span2  disabled" disabled="" placeholder="<?php echo set_value('price_unit', isset($order->price_unit) ? $order->price_unit : ''); ?>">
        <input type="text" name="currency" class="span1  disabled" disabled="" placeholder="<?php echo set_value('currency', isset($order->currency) ? $order->currency : 'EUR'); ?>">
      </div>
    </fieldset>
    <fieldset class="control-group">
      <label for="quantity" class="control-label">Quantity</label>
      <div class="controls">
        <input type="text" name="quantity" class="span2  disabled" disabled="" placeholder="<?php echo set_value('quantity', isset($order->quantity) ? $order->quantity : '1'); ?>">
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
    <fieldset class="control-group">
      <label for="account" class="control-label">Account</label>
      <div class="controls">
        <input type="text" name="account" class="span4  disabled" placeholder="<?php echo set_value('account', isset($order->account) ? $order->account : ''); ?>" disabled="">
      </div>
    </fieldset>
	<fieldset class="control-group">
      <label for="input01" class="control-label">Comment</label>
      <div class="controls">
        <textarea rows="3" id="textarea" name="comment" class="span4 disabled" disabled=""><?php echo set_value('price_unit', isset($order->comment) ? $order->comment : ''); ?></textarea>
      </div>
    </fieldset>
	<fieldset class="form-actions">
    	<a href="<?php echo base_url();?>orders/" type="reset" class="btn btn-large">Cancel</a>
	</fieldset>