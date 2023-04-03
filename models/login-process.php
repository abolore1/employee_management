<?php
 session_start();
 error_reporting(0);
 
 include_once('../functions/function.php');

  $my_email =  test_input($_POST["email"]);
  $my_password =  test_input(base64_encode($_POST["password"]));
  
  $sql = "SELECT * FROM employeelogin WHERE email = '$my_email' AND password = '$my_password' ";
  $result = mysqli_query($conn, $sql);
   
  if($rows = mysqli_fetch_array($result)) {
    echo "success"; //same in the ajax
    // Creating session
    $_SESSION["fullname"] = $rows['fullname'];
    $_SESSION['id'] = $rows['id'];
    $_SESSION['email'] = $rows['email'];
    $_SESSION['loginsession'] = $rows['id'];

    
  }
?>
