<h1 class="page-header">Manage Users <small>Activate, add, delete,...</small></h1>
<table class="zebra-striped bordered-table">
  <thead>
    <?php foreach( $fields as $field_name => $field_display): ?>
    <th <?php if ($by == $field_name) echo ($order == 'asc') ? 'class="yellow header headerSortUp"' : 'class="yellow header headerSortDown"'; ?>>
      <?php echo anchor("admin/users/$field_name/" .
        (($order == 'asc' && $by == $field_name) ? 'desc' : 'asc') ,
        $field_display); ?>
    </th>
    <?php endforeach; ?>
  </thead>
  
  <tbody>
    <?php foreach($users as $user): ?>
    <tr>
      <?php foreach($fields as $field_name => $field_display): ?>
      <td>
        <?php echo $user->$field_name; ?>
      </td>
      <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>			
  </tbody>
  
</table>

<?php if (strlen($pagination)): ?>
<div class="pagination">
  <ul>
    <?php echo $pagination; ?>
  </ul>
</div>
<?php endif; ?>