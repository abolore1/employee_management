<?php
    session_start();
    error_reporting(0);  
    if(isset($_SESSION["email"])){
      header("location:index.php");
    }

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

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <style>
    body{
      background-image: url('./bg-image.webp');
      background-repeat: no-repeat;
      background-size: cover;
      width:100%;
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
    <div class="card-body login-card-body">
      <h3 class="login-box-msg">Input Code</>
     
        <div class="input-group mt-4">
          <input id="code-password" type="text" class="form-control" placeholder="Enter Code">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 center mt-4">
            <button type="button" id = "code-input-btn" class="btn btn-success btn-block" onclick="submitcode()">Submit</button>
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

<script>
   $('#code-password').focus()
 function submitcode(){
   let code_password = $('#code-password').val();

   let data = {"code_password":code_password};
  $.ajax({
    url: '../models/code-login-process.php',
    type:'post',
    data:data,
  success:function(res){
     if(res == 'success'){
      //This suppose to route to index but not working
       self.location = '../views/index.php';
       setTimeout(()=>{
        $('#code-input-btn').html('Submit');
       },3000);
    }
 },
 beforeSend:function(){
  $('#code-input-btn').html('Processing...');
 }
});
  
 }
</script> 

</body>
</html>
