<?php

include '../database.php';
if(!isset($_SESSION['Office'])){header("Location: ../index1");}
$currentpass = $_POST['currentpass'];
$newpass = $_POST['newpass'];
$confirmpass = $_POST['confirmpass'];

// Check if image file is selected
if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image']['name'];
    $target_dir = "../file/"; // Specify the directory where you want to save uploaded images
    $target_file = $target_dir . basename($image);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";

            // Update image path in database
            $sql = "UPDATE tbl_users SET Image='$target_file' WHERE Password='$currentpass'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>window.location.href = 'recpass'</script>";
            } else {
                echo "Error updating image path: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

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
                            window.location.href = "recpass";
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
                        window.location.href = "recpass";
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
