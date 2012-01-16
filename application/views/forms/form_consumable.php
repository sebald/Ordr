<?php $this->load->helper('taxonomies'); ?>

<?php if(isset($consumable)) : ?>
	<form class="form-horizontal">
		<legend>Internal Information</legend>
		<fieldset class="control-group">
          <label for="identifier" class="control-label">ID</label>
          <div class="controls">
            <input type="text" disabled="" placeholder="<?php echo $consumable->id; ?>" name="disabledInput" id="identifier" class="span1 disabled">
          </div>
        </fieldset>
		<fieldset class="control-group">
          <label for="date_created" class="control-label">Created on</label>
          <div class="controls">
            <input type="text" disabled="" placeholder="<?php echo $consumable->date_created; ?>" name="date_created" id="disabledInput" class="span2 disabled">
          </div>
        </fieldset>
		<fieldset class="control-group">
          <label for="date_modified" class="control-label">Last modified</label>
          <div class="controls">
            <input type="text" disabled="" placeholder="<?php echo (strtotime($consumable->date_modified)) ? $consumable->date_modified : 'never'; ?>" name="date_modified" id="disabledInput" class="span2 disabled">
          </div>
        </fieldset>                		
	</form>
<?php endif; ?>

<?php echo form_open($action, 'class="form-horizontal" autocomplete="off"'); ?>
<legend>Item Information</legend>
<fieldset class="control-group<?php if(form_error('CAS_description')) echo ' error'; ?>">
  <label for="CAS_description" class="control-label">CAS / Description</label>
  <div class="controls">
    <input type="text" name="CAS_description" class="span4" value="<?php echo set_value('CAS_description', isset($consumable->CAS_description) ? $consumable->CAS_description : ''); ?>">
    <?php echo form_error('CAS_description','<span class="help-inline">','</span>'); ?>
  </div>
</fieldset>
<fieldset class="control-group<?php if(form_error('category')) echo ' error'; ?>">
  <label for="category" class="control-label">Category</label>
  <div class="controls">
    <select name="category" class="span2">
		<?php foreach (get_consumable_categories() as $c) { ?>
			<option<?php echo (isset($consumable->category) && (@$consumable->category == $c) ) ? ' selected="selected"' : ''; ?>><?php echo $c; ?></option>
		<?php } ?>
    </select>
    <?php echo form_error('category','<span class="help-inline">','</span>'); ?>
  </div>
</fieldset>			        
<fieldset class="control-group<?php if(form_error('catalog_number')) echo ' error'; ?>">
  <label for="catalog_number" class="control-label">Catalog Number</label>
  <div class="controls">
    <input type="text" name="catalog_number" class="span3" value="<?php echo set_value('catalog_number', isset($consumable->catalog_number) ? $consumable->catalog_number : ''); ?>">
    <?php echo form_error('catalog_number','<span class="help-inline">','</span>'); ?>
  </div>
</fieldset>
<fieldset class="control-group<?php if(form_error('vendor')) echo ' error'; ?>">
  <label for="vendor" class="control-label">Vendor</label>
  <div class="controls">
    <input type="text" name="vendor" class="span3" value="<?php echo set_value('vendor', isset($consumable->vendor) ? $consumable->vendor : ''); ?>">
    <?php echo form_error('vendor','<span class="help-inline">','</span>'); ?>
  </div>				          			          
</fieldset>
<fieldset class="control-group<?php if(form_error('package_size')) echo ' error'; ?>">
  <label for="package_size" class="control-label">Package Size</label>
  <div class="controls">
    <input type="text" name="package_size" class="span2" value="<?php echo set_value('package_size', isset($consumable->package_size) ? $consumable->package_size : ''); ?>">
    <?php echo form_error('package_size','<span class="help-inline">','</span>'); ?>
  </div>				          			          
</fieldset>
<legend>Pricing</legend>
<fieldset class="control-group<?php if(form_error('price_unit')) echo ' error'; ?>">
  <label for="price_unit" class="control-label">Unit Price</label>
  <div class="controls">
    <input type="text" name="price_unit" class="span2" value="<?php echo set_value('price_unit', isset($consumable->price_unit) ? $consumable->price_unit : ''); ?>">
    <input type="text" name="currency" class="span1" value="<?php echo set_value('currency', isset($consumable->currency) ? $consumable->currency : 'EUR'); ?>" data-provide="typeahead" data-data='<?php echo convert_for_typeahead(get_currencies()); ?>'>
    <?php echo form_error('price_unit','<span class="help-inline">','</span>'); ?>
  </div>
</fieldset>
<legend>Optional Information</legend>
<fieldset class="control-group<?php if(form_error('comment')) echo ' error'; ?>">
  <label for="comment" class="control-label">Comment</label>
  <div class="controls">
    <textarea rows="3" id="textarea" name="comment" class="span4"><?php echo set_value('comment', isset($consumable->comment) ? $consumable->comment : ''); ?></textarea>
    <?php echo form_error('comment','<p class="help-block">','</p>'); ?>
  </div>
</fieldset>
<fieldset class="form-actions">
	<button type="submit" class="btn large primary">Create Consumable</button>
	<button type="reset" class="btn large">Cancel</button>
</fieldset>      					        
<?php echo form_close(); ?>