<?php
include_once('../functions/function.php');
error_reporting(0);

$to_email = $_POST['email'];

if (checkuser($to_email)) {
   try {
      $random_number = rand(1, 9999);
      $random_output = $random_number;
      $encodedRandom =  base64_encode($random_number);
      $message = 'Your login code is:- ' . $random_output;
      $subject = 'Login Code Request';

      mail($to_email,$subject, $message);


      $sql = "UPDATE employeelogin SET password = '$encodedRandom' WHERE email = '$to_email' ";
      $response = mysqli_query($conn, $sql);
      if ($response) {
         echo 'success';
      } else {
         echo "Error updating record: " . mysqli_error($conn);
      }
   } catch (phpMailerException $e) {
      echo $e->errorMessage();
   }
} else {
   echo 'Please provide correct email!';
}
