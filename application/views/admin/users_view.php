<h1 class="page-header">Manage Users <small>Activate, add, delete,...</small></h1>
<?php echo $this->session->flashdata('message'); ?>
<table>
  <thead>
    <?php foreach( $fields as $field_name => $field_display): ?>
    <th class="sortable blue header<?php if ($by == $field_name) echo ($order == 'asc') ? ' headerSortUp' : ' headerSortDown'; ?>">
      <?php echo anchor("admin/users/view/$filter/$field_name/" .
        (($order == 'asc' && $by == $field_name) ? 'desc' : 'asc') ,
        $field_display); ?>
    </th>
    <?php endforeach; ?>
    <th>
    	Actions
    </th>
  </thead>
  
  <tbody>
    <?php foreach($users as $user): ?>
    <tr>
      <?php foreach($fields as $field_name => $field_display): ?>
      <td>
        <?php echo $user->$field_name; ?>
      </td>
      <?php endforeach; ?>
      <td>
      	<?php echo anchor('admin/users/edit/'.$user->username, 'edit'); ?>
      	<?php echo table_action('delete', 'admin/users/delete', $user->username); ?>
      </td>
    </tr>
    <?php endforeach; ?>			
  </tbody>
  
</table>

<?php if (strlen($pagination)): ?>
<div class="pagination center">
  <ul>
    <?php echo $pagination; ?>
  </ul>
</div>
<div style="clear:both;"></div>
<?php endif; ?>