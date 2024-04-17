<?php
include '../database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


  $username = $_POST['username'];
  $owner = $_POST['owner'];
  $suffix = $_POST['suffix'];
  $campus = $_POST['campus'];
  $email = $_POST['email'];
  $office =  $_POST['office'];
  $position = $_POST['position'];
  $password = $_POST['password'];
  $privilege = $_POST['privilege'];

  if (isset($_FILES["file"]["name"])) {
      $img_upload_path = "file/" . $_FILES["file"]["name"];

  // Check if password meets the requirements
  if (preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {

  // Insert the account details and hashed password into the database
  $sql = "INSERT INTO tbl_users (UserName, Password, Owner, Position, Office, Privilege, Campus, Image, Suffix, Email) 
          VALUES ('$username', '$password', '$owner', '$position','$office', '$privilege', '$campus', '$img_upload_path', '$suffix', '$email')";
  if (mysqli_query($conn, $sql)) {
      echo "<script>alert('Username and Password was send in $email')</script>";
      echo "<script>window.location.href = 'admin'</script>";
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  } else {
      echo "<script>alert('Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.')</script";
      echo "<script>window.location.href = 'admin/      admin'</script>";
    }
}



  $subject = "  Account activated";
  $message = "Dear $owner, Mr. or Mrs. <br><br>

Hope this greeting finds you in good health. <br><br>

Your account has been successfully established and is now operational, I'm happy to tell you. Your login credentials are listed below: <br><br>

Login: $username <br>
Password: $password <br>

We advise changing your password after your initial login in order to improve security. The actions to take are as follows: <br><br>

1. Please visit [www.neustdocumenttracking.com]. <br>
2. 'Login' is the button to click. <br>
3. Enter the given password along with your login. <br>
4. Proceed to 'MY ACCOUNT' to generate a robust, new password. <br> <br>

Please get in touch with us if you run into any problems or have any more questions. <br><br>

I appreciate you taking the time to consider this. <br><br>

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

  if (move_uploaded_file($_FILES['file']['tmp_name'], 'file/' . $_FILES['file']['name'])) {
      // File was successfully moved to the "file" directory
  }
?>