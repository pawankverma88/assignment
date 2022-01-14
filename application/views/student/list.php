<!DOCTYPE html>
<html>
<head>
  <title>Students</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<style>
table { font-family: arial, sans-serif; border-collapse: collapse; width: 100%; }
td, th { border: 1px solid #dddddd; text-align: left; padding: 8px; }
tr:nth-child(even) { background-color: #dddddd; }

button { width: 70px; height: 25px; background: #10a6be; margin-right: 5px; text-align: center; border-radius: 5px; color: white; font-weight: bold; line-height: 17px; display:inline; }

.add-button { background: #10a6be; text-decoration: none; padding: 5px; margin-right: 5px; text-align: center; border-radius: 5px; color: white; font-weight: bold; line-height: 17px; display:inline; float: right; }
.edit_button { background: #10a6be; text-decoration: none; padding: 5px; margin-right: 5px; text-align: center; border-radius: 5px; color: white; font-weight: bold; line-height: 17px; display:inline;  }
.dele_button { background: #a94409; text-decoration: none; padding: 5px; margin-right: 5px; text-align: center; border-radius: 5px; color: white; font-weight: bold; line-height: 17px; display:inline;  }
</style>
</head>
<body>

<h2>Students</h2>
<form class="form-inline">
  <label for="search_by">Search By:</label>
    <select id="search_by" name="search_by">
      <option value="name">Name</option>
      <option value="phone">Contact No</option>
    </select>
  <label for="keyword">Keyword:</label>
  <input type="keyword" id="keyword" placeholder="Enter keyword " name="keyword" required="">
  <button type="submit">Submit</button>
  <a href="<?php echo base_url('student/add'); ?>" class="add-button">Add Student</a>
</form>
<br>
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Mobile Number</th>
      <th>Address</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody id="students-list">
    
  </tbody>
</table>
<script type="text/javascript">
  
  function get_students(search_by = '', keyword = '')
  {
    $.ajax({
      url: '<?php echo base_url('student/student_ajax_list'); ?>',
      data: {search_by:search_by,keyword:keyword},
      type: 'post',
      dataType: 'json',
      success: function(response){
        $('#students-list').html(response.html);
      }
    })  
  }

  $(function(){
    get_students();

    $('.form-inline').submit(function(e){
      e.preventDefault();
      var search_by = $('#search_by option:selected').val();
      var keyword = $('#keyword').val();
      get_students(search_by, keyword);
    });
  })
</script>
</body>
</html>

