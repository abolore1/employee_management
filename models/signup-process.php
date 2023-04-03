<?php
   error_reporting(0);
   include_once('../functions/function.php');
   
   $myfullname = $_POST["fullname"];
   $mymail = $_POST["email"];
   $mypassword = base64_encode($_POST["password"]);

 if(!checkuser($mymail)) {  // to check if user already exist in the database
   $signup = "INSERT INTO employeelogin (fullname, email, password)
   VALUES('$myfullname', '$mymail', '$mypassword')";
   
   $result = mysqli_query($conn, $signup);
   
   if($result) {
      echo "success";
   } else {
      echo "Error: " . $query . "<br>" . mysqli_error($conn);
   }
}
else {
 echo "Oops! User Account already exist!";
} 
   
?>