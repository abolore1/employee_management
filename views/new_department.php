  <?php
  include_once('../functions/function.php');
  
  error_reporting(0);
  $query = " SELECT * FROM department ";
  $response = mysqli_query($conn, $query);
  ?>
 
  <label>Department</label>
  <select class="form-control" id="department">
    <option value="">Select Department</option>

   <?php 
     while($rows = mysqli_fetch_array($response)){
        $id = $rows['id'];
        $department = $rows['departmentname'];
      ?>
      <option value="<?=$id?>"><?=$department?></option>
   <?php     
     }
   
   ?>

  </select>



