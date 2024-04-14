<?php

include '../database.php';

$currentpass = $_POST['currentpass'];
$newpass = $_POST['newpass'];
$confirmpass = $_POST['confirmpass'];
    

// Current password is correct
if($currentpass){
    $sql = "SELECT * FROM tbl_users WHERE Password='$currentpass'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        // Confirm new password
        if ($newpass !== $confirmpass) {
            echo "New passwords do not match.";
        } else {
            // Enforce restrictions
            if (preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $newpass)) {
                // Update database
                $sql = "UPDATE tbl_users SET Password='$newpass' WHERE Password='$currentpass'";
                if (mysqli_query($conn, $sql)) {
                    echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var sweetAlertScript = document.createElement("script");
                        sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
                        document.head.appendChild(sweetAlertScript);
            
                        sweetAlertScript.onload = function() {
                            swal({
                            title: "Change Successful",
                            text: "Change Password",
                            icon: "success",
                            buttons: false,
                            timer: 1200
                            }).then(function() {
                            window.location.href = "my_account";
                            });
                        };
                    });
                    </script>';
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    var sweetAlertScript = document.createElement("script");
                    sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
                    document.head.appendChild(sweetAlertScript);
        
                    sweetAlertScript.onload = function() {
                        swal({
                        title: "Archived Successful",
                        text: "New password must be at least 8 characters long and contain at least one letter and one number.",
                        icon: "warning",
                        buttons: false,
                        timer: 1200
                        }).then(function() {
                        window.location.href = "my_account";
                        });
                    };
                });
                </script>';
            }
        }
    } else {
        echo "Current password is incorrect.";
    }
}

?>
