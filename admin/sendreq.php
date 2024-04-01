<?php
include '../database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


$user = $_POST['users'];
$pass = $_POST['pass'];
$email = $_POST['email'];
$uniqueId = $_POST['unique_id'];

$subject = "Document Status Update in campus";
$message = "Greetings campus<br>
Your document Username : $user <br> Password : $pass.";
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'docutracking01@gmail.com';
$mail->Password = 'jiejyzzhrhpjltug';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('docutracking01@gmail.com');
$mail->addAddress($email);
$mail->isHTML(true);

$mail->Subject = $subject;
$mail->Body = $message;

    $mail->send();


$updateQuery = "UPDATE tbl_users SET Letter = '', Request = '' WHERE ID = $uniqueId";
$conn->query($updateQuery);
echo '<script>
document.addEventListener("DOMContentLoaded", function() {
  var sweetAlertScript = document.createElement("script");
  sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
  document.head.appendChild(sweetAlertScript);

  sweetAlertScript.onload = function() {
    swal({
      title: "Update Successful",
      text: "Successful",
      icon: "success",
      buttons: false,
      timer: 1200
    }).then(function() {
      window.location.href = "request";
    });
  };
});
</script>';
?>