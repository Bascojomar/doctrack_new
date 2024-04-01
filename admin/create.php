<?php
include 'database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


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



  $subject = "Account Approval";
  $message = "Mr. or Mrs. $owner. <BR><BR>
  Your account has been successfully created and is now ready for use. Here are your login credentials:
  Username:$username<br>
  Password: $password 
  <br><br>
  To improve security, we recommend changing your password after your initial login. <br>
  1.Go to [www.neustdocumenttracking.com] <br>2. Click the 'Login' button.
  <br>3. Enter your username and the previously created password. 
  <br>4. In 'MY ACCOUNT', you can create a new strong password.";

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