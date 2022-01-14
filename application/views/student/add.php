<!DOCTYPE html>
<html>
<head>
  <title>Add Student</title>
  <style>
  button { width: 70px; height: 25px; background: #0e920c; margin-right: 5px; text-align: center; border-radius: 5px; color: white; font-weight: bold; line-height: 17px; display:inline; }
  .name {margin-left: 65px; margin-bottom: 22px; border: 2px solid #ccc; border-radius: 4px; background-color: #f8f8f8;}
  .mobile {margin-left: 1px; margin-bottom: 22px; border: 2px solid #ccc; border-radius: 4px; background-color: #f8f8f8;}
  textarea {border: 2px solid #ccc; border-radius: 4px; background-color: #f8f8f8;}
  </style>
</head>
<body>

<h2>Add Student</h2>
<?php if (isset($error_message)) { ?>
  <span><?php echo $error_message; ?></span>
<?php } ?>
<?php if (isset($success_message)) { ?>
  <span><?php echo $success_message; ?></span>
<?php } ?>
<form action="<?php echo current_url(); ?>" method="post">
  <label for="name">Name*:</label>
  <input type="text" class="name" id="name" name="name" value="<?php echo (isset($name))?$name:''; ?>" required=""><br>
  <label for="mobile_number">Mobile Number*:</label>
  <input type="text" class="mobile" id="mobile_number" name="mobile_number" value="<?php echo (isset($mobile_number))?$mobile_number:''; ?>" required=""><br>
  <label for="address">Address*:</label>
  <textarea id="address" name="address" required=""><?php echo (isset($address))?$address:''; ?></textarea><br><br>
  <button type="submit">Submit</button>
</form> 
</body>
</html>