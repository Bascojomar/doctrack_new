<?php
include '../database.php';
session_start();

if (isset($_POST['submit'])) {
  // Sanitize input to prevent SQL injection
  $reference = mysqli_real_escape_string($conn, $_POST['reference']);
  $date1 = date('y-m-d');

  // Check if the reference exists in the database
  $checkQuery = "SELECT * FROM tbl_inout WHERE Reference = '$reference' and DocInOut = 'IN' and Channel = 'VPRET'";
  $result = $conn->query($checkQuery);

  if ($result->num_rows > 0) {
      // Perform the database update
      $updateQuery = "UPDATE tbl_inout SET CDate = '$date1', DocStatus = 'RECEIVED', Remarks = 'FOR SIGNATURE' WHERE Reference = '$reference' and DocInOut = 'IN' and Channel = 'VPRET'";
      
      if ($conn->query($updateQuery) === TRUE) {
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
                window.location.href = "vpret1";
              });
            };
          });
          </script>';
      } else {
          echo "<script>alert('Error updating the database');</script>";
      }
  } else {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
      var sweetAlertScript = document.createElement("script");
      sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
      document.head.appendChild(sweetAlertScript);
    
      sweetAlertScript.onload = function() {
        swal({
          title: "No Rerenece",
          text: "No Reference",
          icon: "warning",
          buttons: false,
          timer: 1200
        }).then(function() {
          window.location.href = "vpret1";
        });
      };
    });
    </script>';
  }
}

?>