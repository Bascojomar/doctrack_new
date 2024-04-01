<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


include '../database.php';
session_start();
// Assuming you have a database connection established in $conn

if (isset($_POST['send_pass'])) {
    $user_id_to_delete = $_POST['id'];

    // Display a confirmation dialog using JavaScript
    echo "<script>
            var userConfirmed = confirm('Are you sure you want to Send this Username and Password?');
            if (userConfirmed) {
                window.location.href = 'send_pass?id=$user_id_to_delete&confirmed=1';
            } else {
                window.location.href = 'admin';
            }
          </script>";
}

// Check for confirmation parameter and perform the deletion
if (isset($_GET['confirmed']) && $_GET['confirmed'] == 1) {
    $user_id_to_delete = $_GET['id'];
    
        $sql = "SELECT * FROM tbl_users WHERE ID = '$user_id_to_delete'";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['UserName'];
            $pass = $row['Password'];
            $campus = $row['Campus'];
            $email = $row['Email'];
    
        $subject = "Sending Password";
        $message = "Greetings, $campus (campus)<br><br>
        Username: $username <br><br>
        Password: $pass";
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
    
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
              var sweetAlertScript = document.createElement("script");
              sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
              document.head.appendChild(sweetAlertScript);
            
              sweetAlertScript.onload = function() {
                swal({
                  title: "Successful Sending Password",
                  text: "Send",
                  icon: "success",
                  buttons: false,
                  timer: 1200
                }).then(function() {
                  window.location.href = "admin";
                });
              };
            });
            </script>';
            
    }
    }
?>

