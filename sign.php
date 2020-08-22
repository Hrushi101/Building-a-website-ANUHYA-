<?php
include_once 'dbh.php';

$name = $_POST['name'];
$cnum = $_POST['cnum'];
$wnum = $_POST['wnum'];
$email = $_POST['email'];
$age = $_POST['age'];
$male = $_POST['male'];
$skill = $_POST['skill'];
$sql = "INSERT INTO form (form_name, form_cnum, form_wcum, form_email,
        form_age, form_male, form_skill) VALUES ('$name', '$cnum',
        '$wnum', '$email', '$age', '$male', '$skill');";
mysqli_query($conn, $sql);
header("Location: click.php?signup=success");
if(isset($_POST['submit'])) {
  require 'PHPMailerAutoload.php';
  require 'credential.php';
  $message = "hi";
  $subject = "hello";

  $mail = new PHPMailer;


  // $mail->SMTPDebug = 4;                               // Enable verbose debug output

  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = EMAIL;                 // SMTP username
  $mail->Password = PASS;                           // SMTP password
  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;                                    // TCP port to connect to

  $mail->setFrom(EMAIL, 'anuhya');
  $mail->addAddress($_POST['email']);     // Add a recipient

  $mail->addReplyTo(EMAIL);
  // print_r($_FILES['file']); exit;
  for ($i=0; $i < count($_FILES['file']['tmp_name']) ; $i++) {
    $mail->addAttachment($_FILES['file']['tmp_name'][$i], $_FILES['file']['name'][$i]);    // Optional name
  }
  $mail->isHTML(true);                                  // Set email format to HTML

  $mail->Subject = $subject;
  $mail->Body    = '<div style="border:2px solid red;">This is the HTML message body <b>in bold!</b></div>';
  $mail->AltBody = $message;

  if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      echo 'Message has been sent';
  }
}


 ?>
