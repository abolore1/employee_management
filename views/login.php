<?php
session_start();
error_reporting(0);
if (isset($_SESSION["email"])) {
  header("location:index.php");
}

if (isset($_GET['action']) and $_GET['action'] == "logout") {
  session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee Management CRUD</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="shortcut icon" href="../views/icon.jfif" type="image/x-icon">
  <style>
    body {
      background-image: url('emp-bg.jpg');
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

    .error {
      background-color: red;
      color: #fff;
      font-size: 1.3em;
    }

    @media only screen and (max-width:300px) {
      .text-white {
        text-align: center;
        max-width: 270px;
        margin: auto;
        padding:0 50% ;
        font-size: 20px;
        text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;

      }
      .card{
        margin-left: 30px;
      }
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <h1 class="text-white" style="width:450px;margin-left:-45px; text-shadow: 2px 2px black;">Employee Management</h2>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <h3 class="login-box-msg ">Sign In</h3>
        <form id="form" method="post">
          <div class="input-group mb-3">
            <input id="email" type="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="password" type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 center"> <br>
              <button type="button" id="loginbtn" class="btn btn-success btn-block" onclick="validate()">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mb-3">
          <a href="forget_password" class="center">
            <h5 class=" mr-2">Forgot password?</h5>
          </a>
          <a href="signup">
            <h5 class="center">Don't have an account? Sign up!</h5>
          </a>

        </div>
      </div>
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
  <script src="../controllers/validate.js"></script>
</body>

</html>