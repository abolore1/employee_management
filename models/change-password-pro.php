<?php 
   session_start();
   include_once('../functions/function.php');
   
   error_reporting(0);

   $my_password = base64_encode($_POST['new_password']);
   $sql = "UPDATE employeelogin SET password = '$my_password' WHERE email = '".$_SESSION['email']."' ";
   $response = mysqli_query($conn,$sql);
   if($response) {
      echo 'success';
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
 
   exit;
?>
    