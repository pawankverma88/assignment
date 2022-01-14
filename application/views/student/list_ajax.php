<?php if ($students) { ?>
  <?php foreach ($students as $key => $value) { ?>
    <tr>
      <td><?php echo $value->name; ?></td>
      <td><?php echo $value->phone_no; ?></td>
      <td><?php echo $value->address; ?></td>
      <td>
        <a class="edit_button" href="<?php echo base_url('student/edit/'.$value->id); ?>">Edit</a>
        <a class="dele_button" href="<?php echo base_url('student/delete/'.$value->id); ?>" onclick="return confirm('Are you sure, you want to delete this student?');">Delete</a>
      </td>
    </tr>
  <?php } ?>
<?php } else { ?>
  <tr><td colspan="4">No record found</td></tr>
<?php } ?>
