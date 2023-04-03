<?php
    session_start();
    error_reporting(0);  
    // if(isset($_SESSION["email"])){
    //   header("location:index.php");
    // }

   if(isset($_GET['action']) and $_GET['action']=="logout"){
      session_destroy();
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee Management CRUD</title>
  <link rel="shortcut icon" href="../views/icon.jfif" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../dist/css/styles.css">
  <style>
    body{
      background-image: url('../bg-image.webp');
      background-attachment:fixed ;
      background-repeat: no-repeat;
      background-size: cover;
      width: 100%;
      margin: auto;
      background-position: center;
      height: fit-content;
    }

    @media only screen and (max-width:312px) {
      .btn-success{
        width: fit-content;
      }
    }
    @media only screen and (max-width:96px) {
      .btn-success{
        width: 13px;
      }
    }
  
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><h2 class="text-primary">Employee Management</h2></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body forgotpassword-card-body">
      <h3 class="login-box-msg">Password Request</h3>
      
        <div class="input-group ">
          <input id="reset-email" type="email" class="form-control" placeholder="Enter Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 center"> <br>
            <button type="button" id = "password-reset-btn" class="btn btn-success btn-block" onclick="sendcode()">Submit</button>
          </div>
          <!-- /.col -->
        </div>
     
      <div class="social-auth-links text-center ">
        <div  class=" bg-success code_success_msg mb-2" style= "display:none;height:15px; width:100%";></div>
        <h4 class="code_success_msg" style="display: none;">Reset code has been sent to your email.</h4>
      </div>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
 <!-- validation function -->
 <script src="../controllers/forget_password.js"></script> 
<script>
    $('#reset-email').focus ();
</script> 

</body>
</html>
