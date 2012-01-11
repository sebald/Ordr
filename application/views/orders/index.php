<?php
	$attr_input_search = array(
          'name'        => 'search',
          'type'		=> 'search',
          'size'        => '30',
          'placeholder' => 'Search'
	);	
	$attr_submit_search = array(
		  'type'		=> 'submit',
          'content'		=> 'Search'
	);
?>	
<hgroup class="page-header">

	<?php echo form_open('orders/search', 'class="search-form"', (isset($filter['display'])) ? array( 'display' => $query_display ) : ''); ?>
		<div class="input-append search">
			<?php echo form_input($attr_input_search, (isset($filter['search'])) ? $filter['search'] : ''); ?>
			<label class="add-on">
				<?php echo form_button($attr_submit_search); ?>
			</label>
	    </div>
	<?php echo form_close(); ?>			
	
	<h1>Orders</h1>
	
	<div class="actions">
		<a href="<?php echo base_url();?>orders/new" rel="twipsy" data-original-title="New" class="btn-flat single"><i class="shop"></i></a> 
		<?php echo form_open('orders/action', '', (isset($filter['display'])) ? array( 'display' => $query_display ) : ''); ?>
			<div class="btn-group">
				<button rel="twipsy" data-original-title="Edit" value="edit" type="submit" name="action" class="btn-flat"><i class="pencil"></i></button>
				<button rel="twipsy" data-original-title="Remove" value="delete" type="submit" name="action" class="btn-flat"><i class="trash"></i></button>	  
			</div>
		<?php echo form_close(); ?>
		<div class="btn-group">
			<a href="#modal-filter" rel="twipsy" data-original-title="Filter Options" class="btn-flat" data-toggle="modal"><i class="abacus"></i></a>
			<a href="#modal-display" rel="twipsy" data-original-title="Display Options" class="btn-flat" data-toggle="modal"><i class="eye"></i></a>
		</div>	
	</div>
	
</hgroup>
<?php echo $this->session->flashdata('message'); ?>
<div class="fluid-container sidebar-left">
	<aside class="fluid-sidebar">
		<ul class="well nav list">
			<li class="nav-header">My Orders</li>
	        <li class="active"><a href="#" class="nav-item">All</a></li>
	        <li><a href="#" class="nav-item">Open</a></li>
	        <li><a href="#" class="nav-item">On order</a></li>
	        <li><a href="#" class="nav-item">Completed</a></li>	
			<li class="nav-header">Work Status</li>
	        <li><a href="#" class="nav-item">All</a></li>
	        <li><a href="#" class="nav-item">Open</a></li>
	        <li><a href="#" class="nav-item">On order</a></li>
	        <li><a href="#" class="nav-item">Completed</a></li>		
		</ul>
	</aside>
	<div class="fluid-content">
		<table>
		  <thead>
		  	<tr><th class="center">
		  		<input type="checkbox" value="all" name="mark_all">		  	</th>
		    		    <th class="sortable blue header headerSortUp">
		      <a href="http://localhost/ordr/admin/users/view/all/username/desc/">Username</a>		    </th>
		    		    <th class="sortable blue header">
		      <a href="http://localhost/ordr/admin/users/view/all/first_name/asc/">First Name</a>		    </th>
		    		    <th class="sortable blue header">
		      <a href="http://localhost/ordr/admin/users/view/all/last_name/asc/">Last Name</a>		    </th>
		    		    <th class="sortable blue header">
		      <a href="http://localhost/ordr/admin/users/view/all/email/asc/">Email</a>		    </th>
		    		    <th class="sortable blue header">
		      <a href="http://localhost/ordr/admin/users/view/all/role/asc/">Role</a>		    </th>
		    		    <th>Actions</th>
		  </tr></thead>
		  
		  <tbody>
		    		    <tr>
		      <td class="center">
		      	<input type="checkbox" value="MrDidi" name="marked[]">		      </td>
		      		      <td>
		        MrDidi		      </td>
		      		      <td>
		        Mr		      </td>
		      		      <td>
		        Didi		      </td>
		      		      <td>
		        sdsdsda@sds.com		      </td>
		      		      <td>
		        user		      </td>
		      		      <td>
		      	<a title="Edit User" class="action edit" href="http://localhost/ordr/admin/users/edit/MrDidi/">edit</a>		      	<a title="Delete User" class="action delete" href="http://localhost/ordr/admin/users/delete/MrDidi/">delete</a>		      </td>
		    </tr>
		    		    <tr>
		      <td class="center">
		      	<input type="checkbox" value="MrDooDoo" name="marked[]">		      </td>
		      		      <td>
		        MrDooDoo		      </td>
		      		      <td>
		        Mr		      </td>
		      		      <td>
		        DooDoo		      </td>
		      		      <td>
		        sdsda@sds.com		      </td>
		      		      <td>
		        purchaser		      </td>
		      		      <td>
		      	<a title="Edit User" class="action edit" href="http://localhost/ordr/admin/users/edit/MrDooDoo/">edit</a>		      	<a title="Delete User" class="action delete" href="http://localhost/ordr/admin/users/delete/MrDooDoo/">delete</a>		      </td>
		    </tr>
		    		    <tr>
		      <td class="center">
		      	<input type="checkbox" value="MrNiceGuy" name="marked[]">		      </td>
		      		      <td>
		        MrNiceGuy		      </td>
		      		      <td>
		        MrNice		      </td>
		      		      <td>
		        Guy		      </td>
		      		      <td>
		        sda@sds.com		      </td>
		      		      <td>
		        user		      </td>
		      		      <td>
		      	<a title="Edit User" class="action edit" href="http://localhost/ordr/admin/users/edit/MrNiceGuy/">edit</a>		      	<a title="Delete User" class="action delete" href="http://localhost/ordr/admin/users/delete/MrNiceGuy/">delete</a>		      </td>
		    </tr>
		    		    <tr>
		      <td class="center">
		      	<input type="checkbox" value="SebastianSebald" name="marked[]">		      </td>
		      		      <td>
		        SebastianSebald		      </td>
		      		      <td>
		        Sebastian		      </td>
		      		      <td>
		        Sebald		      </td>
		      		      <td>
		        sebastian@sebald.com		      </td>
		      		      <td>
		        admin		      </td>
		      		      <td>
		      	<a title="Edit User" class="action edit" href="http://localhost/ordr/admin/users/edit/SebastianSebald/">edit</a>		      	<a title="Delete User" class="action delete" href="http://localhost/ordr/admin/users/delete/SebastianSebald/">delete</a>		      </td>
		    </tr>
		    		    <tr>
		      <td class="center">
		      	<input type="checkbox" value="SpagetthiMonster" name="marked[]">		      </td>
		      		      <td>
		        SpagetthiMonster		      </td>
		      		      <td>
		        Spagetthi		      </td>
		      		      <td>
		        Monster		      </td>
		      		      <td>
		        spagetthi@monter.com		      </td>
		      		      <td>
		        user		      </td>
		      		      <td>
		      	<a title="Edit User" class="action edit" href="http://localhost/ordr/admin/users/edit/SpagetthiMonster/">edit</a>		      	<a title="Delete User" class="action delete" href="http://localhost/ordr/admin/users/delete/SpagetthiMonster/">delete</a>		      </td>
		    </tr>
		    		    <tr>
		      <td class="center">
		      	<input type="checkbox" value="TomTastic" name="marked[]">		      </td>
		      		      <td>
		        TomTastic		      </td>
		      		      <td>
		        Tom		      </td>
		      		      <td>
		        Tastic		      </td>
		      		      <td>
		        tom@tastic.com		      </td>
		      		      <td>
		        user		      </td>
		      		      <td>
		      	<a title="Edit User" class="action edit" href="http://localhost/ordr/admin/users/edit/TomTastic/">edit</a>		      	<a title="Delete User" class="action delete" href="http://localhost/ordr/admin/users/delete/TomTastic/">delete</a>		      </td>
		    </tr>
		    		    <tr>
		      <td class="center">
		      	<input type="checkbox" value="TomTom" name="marked[]">		      </td>
		      		      <td>
		        TomTom		      </td>
		      		      <td>
		        Tom		      </td>
		      		      <td>
		        Tom		      </td>
		      		      <td>
		        tom@tom.com		      </td>
		      		      <td>
		        inactive		      </td>
		      		      <td>
		      	<a title="Edit User" class="action edit" href="http://localhost/ordr/admin/users/edit/TomTom/">edit</a>		      	<a title="Delete User" class="action delete" href="http://localhost/ordr/admin/users/delete/TomTom/">delete</a>		      </td>
		    </tr>
		    		    <tr>
		      <td class="center">
		      	<input type="checkbox" value="UserFive" name="marked[]">		      </td>
		      		      <td>
		        UserFive		      </td>
		      		      <td>
		        User		      </td>
		      		      <td>
		        Five		      </td>
		      		      <td>
		        user@five.com		      </td>
		      		      <td>
		        user		      </td>
		      		      <td>
		      	<a title="Edit User" class="action edit" href="http://localhost/ordr/admin/users/edit/UserFive/">edit</a>		      	<a title="Delete User" class="action delete" href="http://localhost/ordr/admin/users/delete/UserFive/">delete</a>		      </td>
		    </tr>
		    		    <tr>
		      <td class="center">
		      	<input type="checkbox" value="UserFour" name="marked[]">		      </td>
		      		      <td>
		        UserFour		      </td>
		      		      <td>
		        User		      </td>
		      		      <td>
		        Four		      </td>
		      		      <td>
		        user@four.com		      </td>
		      		      <td>
		        user		      </td>
		      		      <td>
		      	<a title="Edit User" class="action edit" href="http://localhost/ordr/admin/users/edit/UserFour/">edit</a>		      	<a title="Delete User" class="action delete" href="http://localhost/ordr/admin/users/delete/UserFour/">delete</a>		      </td>
		    </tr>
		    		    <tr>
		      <td class="center">
		      	<input type="checkbox" value="UserOne" name="marked[]">		      </td>
		      		      <td>
		        UserOne		      </td>
		      		      <td>
		        User		      </td>
		      		      <td>
		        One		      </td>
		      		      <td>
		        user@user.com		      </td>
		      		      <td>
		        user		      </td>
		      		      <td>
		      	<a title="Edit User" class="action edit" href="http://localhost/ordr/admin/users/edit/UserOne/">edit</a>		      	<a title="Delete User" class="action delete" href="http://localhost/ordr/admin/users/delete/UserOne/">delete</a>		      </td>
		    </tr>
		    			
		  </tbody>
			  
			</table>
	</div>
</div>
<div id="modal-filter" class="modal hide fade">
            <div class="modal-header">
              <a href="#" class="close" data-dismiss="modal">×</a>
              <h3>Filter Options</h3>
            </div>
            <div class="modal-body">
				TO DO
            </div>
            <div class="modal-footer">
              <a class="btn primary" href="#">Save changes</a>
              <a data-dismiss="modal" class="btn" href="#">Close</a>
            </div>
</div>
<div id="modal-display" class="modal hide fade">
            <div class="modal-header">
              <a href="#" class="close" data-dismiss="modal">×</a>
              <h3>Display Options</h3>
            </div>
            <div class="modal-body">
            	<p class="help-block"><span class="label notice">Notice</span> If the displayed information is too cluttered, deselect some fields below. This will temporaly remove them from your view and should help you stay on top of things.</p>
				<form class="checklist">
					<fieldset class="left">
			            <label class="checkbox">
			              <input type="checkbox" value="user_id" name="display[]">
			              Purchaser
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="vendor" name="display[]">
			              Vendor
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="catalog_number" name="display[]">
			              Catalog Number
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="CAS_description" name="display[]">
			              CAS / Description
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="price_unit" name="display[]">
			              Unit Price
			            </label>						
					</fieldset>
					<fieldset class="right">
			            <label class="checkbox">
			              <input type="checkbox" value="quantity" name="display[]">
			              Quantity
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="price_total" name="display[]">
			              Total Price
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="account" name="display[]">
			              Account
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="work_status" name="display[]">
			              Work Status
			            </label>
			            <label class="checkbox">
			              <input type="checkbox" value="date_created" name="display[]">
			              Date Created
			            </label>							
					</fieldset>            		            		            		            
				</form>
            </div>
            <div class="modal-footer">
              <a class="btn primary" href="#">Apply Changes</a>
              <a data-dismiss="modal" class="btn" href="#">Close</a>
            </div>
</div>