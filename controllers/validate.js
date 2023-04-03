function showAlert(message, className) {
  const div = document.createElement('div');
  div.className = `alert ${className}`;
  div.appendChild(document.createTextNode(message));
  const container = document.querySelector('.login-card-body');
  const after = document.querySelector('.login-box-msg');
  container.insertBefore(div,after); //what and where

  setTimeout(function() {
    document.querySelector('.alert').remove();
  }, 3000);

}



function validate(){
  let email = $("#email").val();
  let password = $("#password").val();
  
  let data = { 
    "email": email,
    "password": password,
    "action":"logout"
  }
  if(email=='' || password =='' ){
    showAlert('Email and Password required!','error')
    return;
  }

  $.ajax({
  url:"../models/login-process.php",
  type:"post",
  data:data,
  success: function(res){
    if(res == "success" ){
      self.location = "../views/index";
    } 
    else{
      showAlert('Wrong Email or Password,Try again','error')  
      $("#loginbtn").html("Sign In");
      
    }
  },
  beforeSend : function(){
      $("#loginbtn").html("Authenticating...");
  }
  });
}
