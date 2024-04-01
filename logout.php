<?php
    session_start();

    function pathTo($destination){
        /*unset user data*/
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        $_SESSION['status'] = 'invalid';

        // Destroy the session to clear the history
        session_destroy();

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
          var sweetAlertScript = document.createElement("script");
          sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
          document.head.appendChild(sweetAlertScript);
        
          sweetAlertScript.onload = function() {
            swal({
              title: "Log-out Successful",
              text: "LOGOUT",
              icon: "success",
              buttons: false,
              timer: 1200
            }).then(function() {
              window.location.href = "index1";
            });
          };
        });
        </script>';
    }

    // Usage example:
    pathTo('index1');
?>
