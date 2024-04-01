<?php
include 'database.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


$letter = $_POST['letter'];
$request = $_POST['request'];

$email = $_POST['email'];

$query = "UPDATE tbl_users SET Letter='$letter', Request = '$request' WHERE Email ='$email'";
$result = mysqli_query($conn, $query);


// Query to check if the email and campus match a record in tbl_users
$query = "SELECT * FROM tbl_users WHERE Email = '$email'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // User found, fetch the password
    $row = $result->fetch_assoc();
    $password = $row['Password'];
    $user = $row['UserName'];


    // Close the database connection
    $conn->close();
    echo "<script>alert('Sent Letter')</script>";
    echo "<script>window.location.href = 'index1'</script>";
} else {
    // User not found
    // You may want to redirect the user or display an error message here
    echo "Invalid email or office.";
}



$subject = "Document Status Update in offce";
$message = "Greetings office<br>
Waiting to approved by admin";
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
?>