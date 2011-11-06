<h1 class="page-header">Administration <small>Beeing important.</small></h1>

<table class="bordered-table">
  <thead>
    <?php foreach( $fields as $field_name => $field_display): ?>
    <th class="blue">
      <?php echo $field_display; ?>
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

<?php echo anchor('admin/users', 'Manage Users'); ?>