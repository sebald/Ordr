<?php $this->load->helper('taxonomies'); ?>
<?php $mode = empty($mode) ? 'edit' : $mode; ?>

<? $order = ''; // delete me later ?>

<?php echo form_open($action, 'class="form-horizontal" autocomplete="off"'); ?>
	<legend>Item Information</legend>
	<fieldset class="control-group">
      <label for="input01" class="control-label">CAS / Description</label>
      <div class="controls">
        <input type="text" name="input01" class="span3">
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
        <input type="text" name="currency" class="span1" value="EUR" data-provide="typeahead" data-data='<?php echo convert_for_typeahead(get_currencies()); ?>'>
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
<?php echo form_close(); ?>