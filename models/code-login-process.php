<?php
 session_start();
 error_reporting(0);
 
//  include_once('../functions/function.php');
$server = "localhost:3305";
$dbname = "emp_management";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($server, $username, $password, $dbname);

  // $code_password =  test_input(base64_encode($_POST["code_password"]));
  $code_password =  $_POST["code_password"];
 
  $sql = "SELECT * FROM employeelogin WHERE password = '$code_password'";
  $result = mysqli_query($conn, $sql);
 
  if($rows = mysqli_fetch_array($result)) {
    echo "success"; //same in the ajax
  }
?>
