<?php
// Include your database connection code here
include '../database.php';
session_start();
if(!isset($_SESSION['Office'])){header("Location: ../index1");}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if (isset($_POST['archive'])) {
    // Handle the archiving logic
    $archive_id = $_POST['archive_id'];

    // Display a confirmation dialog using JavaScript
	echo "<script>
	var userConfirmed = confirm('Are you sure you want to Update this Request?');
	if (userConfirmed) {
		window.location.href = 'recordscomplete?confirmed=1&id=$archive_id';
	} else {
		window.location.href = 'updaterec';
	}
  </script>";
}

// Check for confirmation parameter and perform the deletion
if (isset($_GET['confirmed']) && $_GET['confirmed'] == 1) {
    $archive_id = $_GET['id'];

    $updateQuery = "UPDATE tbl_inout SET ActionTaken = '-', Remarks = 'SIGNED', DocStatus = 'COMPLETED' WHERE ID = '$archive_id'";
	$result = $conn->query($updateQuery);

    if ($conn->query($updateQuery) === TRUE) {
		
		echo '<script>
		document.addEventListener("DOMContentLoaded", function() {
		  var sweetAlertScript = document.createElement("script");
		  sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
		  document.head.appendChild(sweetAlertScript);
		
		  sweetAlertScript.onload = function() {
			swal({
			  title: "Update Successful",
			  text: "COMPLETED",
			  icon: "success",
			  buttons: false,
			  timer: 1200
			}).then(function() {
			  window.location.href = "updaterec";
			});
		  };
		});
		</script>';

        $sql = "SELECT * FROM tbl_inout WHERE ID = '$archive_id' AND DocInOut = 'IN'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $email = $row['Gmail'];
            $office = $row['Channel'];
            $campus = $row['Campus'];
                    $subject = "Document Status Update in $office <br>";
					$message = "Greetings $campus (campus)<br><br>
					Your document is now completed, Get in Record Section.";
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
        }
    } else {
        echo "Error archiving document: " . $conn->error;
    }
}

?>
