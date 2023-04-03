<?php
// This is display on edit model
include_once('../functions/function.php');
error_reporting(0);
 $mydepartmentid = $_GET['departmentid'];
 
$query = " SELECT * FROM department ORDER BY departmentname";
$response = mysqli_query($conn, $query);
?>
<label>Department</label>
<select class="form-control" id="editdepartment">
  <?php
  while ($rows = mysqli_fetch_array($response)) {
     $department = $rows['departmentname'];
     $id = $rows['id'];
    if ($mydepartmentid === $id) {
  ?>
      <option selected value="<?= $id ?>"> <?= $department ?> </option>
    <?php
    } else {
    ?>
      <option value="<?= $id ?>"> <?= $department ?> </option>
  <?php
    }
  }
  ?>
</select>
