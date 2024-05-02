<?php

include '../database.php';

if (isset($_POST['save'])) {
    // Ensure that the variables are properly sanitized to prevent SQL injection
    $owner = mysqli_real_escape_string($conn, $_POST['owner']);
    $office = mysqli_real_escape_string($conn, $_POST['office']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);

    // Construct the update query
    $updateQuery = "UPDATE tbl_users SET Owner = '$owner', Office = '$office', Position = '$position' WHERE Office = 'RECORDS'";

    // Perform the update operation
    if ($conn->query($updateQuery) === TRUE) {
        // If update successful, display success message using SweetAlert
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var sweetAlertScript = document.createElement("script");
                sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
                document.head.appendChild(sweetAlertScript);

                sweetAlertScript.onload = function() {
                    swal({
                        title: "Change Successful",
                        text: "Account Information updated",
                        icon: "success",
                        buttons: false,
                        timer: 1200
                    }).then(function() {
                        window.location.href = "recpass";
                    });
                };
            });
        </script>';
    } else {
        // If update failed, display error message
        echo "Error updating record: " . $conn->error;
    }
}

?>
