function showAlert(message, className) {
  
  const div = document.createElement('div');
  div.className = `alert ${className}`;
  div.appendChild(document.createTextNode(message));
  const container = document.querySelector('.forgotpassword-card-body');
  const after = document.querySelector('.login-box-msg');
  container.insertBefore(div,after); //what and where

  setTimeout(function() {
    document.querySelector('.alert').remove();
  }, 3000);
}

function sendcode(){
      let email = $('#reset-email').val();
      
     let data = {"email":email};
      if(email ===''){
        showAlert('Email required!','error');
        return;
      }

      $.ajax({
        url:'../models/forgot-password-process.php',
        type:'post',
        data:data,
      success:function(res){
      if(res == 'success'){ 
          $('.code_success_msg').css('display','block');
          $('#password-reset-btn').css('display','none');
          $('.input-group').css('display','none');
          // showAlert(res,'successful');
          setTimeout(()=>{
            $('#password-reset-btn').html('Submit');
            self.location = '../views/login';
          },2000)
      }
       else {
         $('#password-reset-btn').html('Submit'); 
         showAlert(res,'error');
        
      } 
    },
      beforeSend:function(){
          $('#password-reset-btn').html('Processing...');    
        }
  });
  
 }
