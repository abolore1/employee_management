function validateEmail(email) {
  let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function showAlert(message, className) {
  const div = document.createElement('div');
  div.className = `alert ${className}`;
  div.appendChild(document.createTextNode(message));
  const container = document.querySelector('.register-card-body');
  const after = document.querySelector('.login-box-msg');
  container.insertBefore(div,after); //what and where

  setTimeout(function() {
    document.querySelector('.alert').remove();
  }, 3000);

}


function register() {
  let fullname = $("#fullname").val();
  let email = $("#email").val();
  let password = $("#password").val();
  let confirm_password = $("#repeatpassword").val();
 
  let data =  {
    "fullname": fullname,
     "email": email,
     "password": password
 }

  if(password != confirm_password){
     showAlert("Unmatched password!","error");
     return;
  }
  
  if(fullname =="" || email =="" || password == ""){
    showAlert("All fields are required","error");
    return;
  }
  else {
  if(!validateEmail(email)){ 
    $('#wrong-email').html('Wrong email format').css({'display':'block','color':'red'}).fadeOut(5000); 
     return false
  }
  $.ajax({
    url: "../models/signup-process.php",
    type: "post",
    data:data,
       success: function(res){
         if(res == "success"){
           showAlert("You've registered successfully!",'successful');
           setTimeout(function(){  
             self.location = "../views/login";
           },3000);
           
         } else {
            showAlert(res,"error");
            $('.btn-success').html('Sign up');
        }
       },
          beforeSend:function(){
            $('.btn-success').html('Processing...')
          }
  });
  }
}