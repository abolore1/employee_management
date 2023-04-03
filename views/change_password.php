<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee Management CRUD</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="shortcut icon" href="../views/icon.jfif" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <style>
    body{
      /* background-image: url('../bg-image.webp'); */
      background-image: url('bg2.jpg');
      background-attachment:fixed ;
      background-repeat: no-repeat;
      background-size: cover;
      width: 100%;
      margin: auto;
      background-position: center;
      height: fit-content;
    }
    .successful {
      background-color: green;
      color: white;
      font-size: 1.3em;
    }
    .error{
      background-color: red;
      color: #fff;
      font-size: 1.3em;
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
    <div class="card-body forgotpassword-card-body">
      <h3 class="login-box-msg">Change Password</>
     
        <div class="input-group mt-4">
          <input id="password-reset" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 center mt-4">
            <button type="button" id="code-input-btn" class="btn btn-success btn-block" onclick="changePassword()">Submit</button>
          </div>
          <!-- /.col -->
        </div>
      <!-- </form> -->

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
<script src="../controllers/change-password.js"></script>


</body>
</html>
