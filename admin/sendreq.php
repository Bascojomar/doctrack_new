<?php
include '../database.php';

// send password and username
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// Assuming you have a database connection established in $conn

if (isset($_POST['approved'])) {
  $user_id_to_delete = $_POST['id'];

  // Display a confirmation dialog using SweetAlert
  echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
              var sweetAlertScript = document.createElement('script');
              sweetAlertScript.src = 'https://unpkg.com/sweetalert/dist/sweetalert.min.js';
              document.head.appendChild(sweetAlertScript);
              
              sweetAlertScript.onload = function() {
                  swal({
                      title: 'Are you sure?',
                      text:'You want to send this username and password?',
                      icon: 'warning',
                      buttons: true,
                      dangerMode: true,
                  })
                  .then((willDelete) => {
                      if (willDelete) {
                          window.location.href = 'sendreq?id=$user_id_to_delete&confirmed=1';
                      } else {
                          window.location.href = 'request';
                      }
                  });
              };
          });
        </script>";

}


// Check for confirmation parameter and perform the deletion
if (isset($_GET['confirmed']) && $_GET['confirmed'] == 1) {
    $user_id_to_delete = $_GET['id'];
    
        $sql = "SELECT * FROM tbl_users WHERE ID = '$user_id_to_delete'";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = $row['UserName'];
            $pass = $row['Password'];
            $uniqueId = $row['ID'];
            $email = $row['Email'];
            
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
                  title: "Successful Sending Password",
                  text: "Send",
                  icon: "success",
                  buttons: false,
                  timer: 1200
                }).then(function() {
                  window.location.href = "request";
                });
              };
            });
            </script>';
            
            
    }
    }


?>