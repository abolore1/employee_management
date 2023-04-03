<?php
//include_once('../mailer/class.phpmailer.php');

// Fill in your database info below to connect to server;
$servername = "localhost:3305";
$dbname = "emp_management";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// function to fetch existing user email
function checkuser($email)
{
  global $conn;
  $query = mysqli_query($conn, " SELECT * FROM employeelogin WHERE email ='$email' LIMIT 1 ");
  $row = mysqli_fetch_array($query);
  if ($row["email"]) {
    return true;
  } else {
    return false;
  }
}

function send_email($fromemail, $fromname, $to, $subject, $message)
{
  try {

    $mail = new PHPMailer(true); //New instance, with exceptions enabled
    $body             = $message;
    $body             = preg_replace('/\\\\/', '', $body); //Strip backslashes
    $mail->IsSMTP();                           // tell the class to use SMTP
    $mail->SMTPAuth   = true;                  // enable SMTP authentication


    $mail->Host = 'mail.kcysoft.com';
    $mail->Port = '465';
    $mail->Username   = "info@quduskudos.com.ng";     // SMTP server username
    $mail->Password   = "E#9tDZD0k;n%";
    $mail->SMTPSecure = 'ssl';
    //$mail->From       = "info@kcysoft.com.ng";
    //$mail->FromName   = "ATTendee HRM";
    $mail->From       = $fromemail;
    $mail->FromName   = $fromname;
    $mail->AddAddress($to);
    $mail->Subject = $subject;
    $mail->WordWrap = 80;
    $mail->MsgHTML($body);
    $mail->IsHTML(true);

    $mail->Send();

    echo 'Message has been sent now.';
  } catch (phpmailerException $e) {
    echo $e->errorMessage();
  }
  
}
