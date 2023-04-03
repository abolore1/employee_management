<?php
  include_once('../functions/function.php');
  error_reporting(0);
  $myhidden = $_POST['id'];

  $query = "DELETE FROM department WHERE id = '$myhidden'";
  $response = mysqli_query($conn, $query);
   echo "success";
?> 