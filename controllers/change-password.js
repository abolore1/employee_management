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

$('#password-reset').focus()
function changePassword(){
  let new_password = $('#password-reset').val();
 if  (new_password===''){
   showAlert('Password required!','error');
  return false; 
 } 
  
  let data = {"new_password":new_password };
  $.ajax({
    url: '../models/change-password-pro.php',
    type:'post',
    data:data,
    success:function(res){
        res = res.trim();
        if(res == 'success'){
        showAlert('Password reset successfully','successful');
        setTimeout(function(){
          $('#code-input-btn').html('Submit');
          self.location ='login?action=logout';
        },2000) 
       }
      //  else{ alert(res) }
    },
     beforeSend:function(){
        $('#code-input-btn').html('Processing...');
      }
   });
}
