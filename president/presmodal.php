<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

include '../database.php';
session_start();


if (isset($_POST['dateup'])) {
    $reference = $_POST['reference'];
    $action = $_POST['action'];
    $remarks = $_POST['remarks'];
    $doc = $_POST['doc'];

    $updateQuery = "UPDATE tbl_inout SET ActionTaken = '$action', Remarks = '$remarks', DocStatus = '$doc' WHERE Channel = 'PRESIDENT' AND Reference = '$reference' AND DocInOut = 'OUT'";
    $result = $conn->query($updateQuery);

    $updateQuery = "UPDATE tbl_inout SET ActionTaken = '$action', Remarks = '$remarks', DocStatus = CASE 
    WHEN Channel = 'PRESIDENT' AND DocInOut = 'OUT' THEN 'COMPLETED'
    ELSE '-'
  END 
  WHERE Reference = '$reference' and Channel='PRESIDENT'";
  $results = $conn->query($updateQuery);


    if ($result) {
        if ($doc === 'COMPLETED') {
            // Send an email
            $sql = "SELECT * FROM tbl_inout WHERE Channel = 'PRESIDENT' AND Reference = '$reference' AND DocInOut = 'OUT'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $office = $row['Channel'];
                $campus = $row['Campus'];
                $email = $row['Gmail'];
                $subjec = $row['Subject'];
                $subject = "";
                 $message = "Subject: $subjec Reference: <br> $reference <br><br> Dear $campus,  <br><br>

I hope this message finds you well. <br><br>

I am pleased to inform you that the $subjec document, previously under review, has been completed and returned to the Records Office. <br><br>

Please be informed that the document is now available for reference and further action as necessary. <br><br>

Thank you for your cooperation throughout this process. ";
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
                              window.location.href = "update";
                            });
                          };
                        });
                        </script>';
                
            }
        }
        
            elseif ($action === 'DISAPPROVED') {
              echo '<script>
              document.addEventListener("DOMContentLoaded", function() {
                var sweetAlertScript = document.createElement("script");
                sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
                document.head.appendChild(sweetAlertScript);
              
                sweetAlertScript.onload = function() {
                  swal({
                    title: "Update Successful",
                    text: "DISAPPROVED",
                    icon: "success",
                    buttons: false,
                    timer: 1200
                  }).then(function() {
                    window.location.href = "update";
                  });
                };
              });
              </script>';

              $updateQuery = "UPDATE tbl_inout SET ActionTaken = '$action', Remarks = '$remarks', DocStatus = CASE 
              WHEN Channel = 'PRESIDENT' AND DocInOut = 'IN' THEN 'DISAPPROVED'
              ELSE 'NULL'
            END 
            WHERE Reference = '$reference'";
            $results = $conn->query($updateQuery);
                // Send an email
                $sql = "SELECT * FROM tbl_inout WHERE Channel = 'PRESIDENT' AND Reference = '$reference' AND DocInOut = 'OUT'";
                $result = $conn->query($sql);
    
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $email = $row['Gmail'];
                    $subjec = $row['Subject'];
                    $office = $row['Channel'];
                    $campus = $row['Campus'];
    
                    $subject = "Document Status Update in $office";
                    $message = "Greetings, $campus (campus)<br>
                    Reference: $reference br><br>
                    
                    Unfortunately, your MODAL document has been denied or rejected.";
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
    
                        echo '<script>
                        document.addEventListener("DOMContentLoaded", function() {
                          var sweetAlertScript = document.createElement("script");
                          sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
                          document.head.appendChild(sweetAlertScript);
                        
                          sweetAlertScript.onload = function() {
                            swal({
                              title: "Update Successful",
                              text: "DISAPPROVED",
                              icon: "success",
                              buttons: false,
                              timer: 1200
                            }).then(function() {
                              window.location.href = "update";
                            });
                          };
                        });
                        </script>';
                            
                }
            }
                elseif ($action === 'PENDING') {
                  echo '<script>
                  document.addEventListener("DOMContentLoaded", function() {
                    var sweetAlertScript = document.createElement("script");
                    sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
                    document.head.appendChild(sweetAlertScript);
                  
                    sweetAlertScript.onload = function() {
                      swal({
                        title: "Update Successful",
                        text: "PENDING",
                        icon: "success",
                        buttons: false,
                        timer: 1200
                      }).then(function() {
                        window.location.href = "update";
                      });
                    };
                  });
                  </script>';
              

                  $updateQuery = "UPDATE tbl_inout SET ActionTaken = '$action', Remarks = '$remarks', DocStatus = CASE 
                  WHEN Channel = 'RECORDS' AND DocInOut = 'IN' THEN 'PENDING'
                  ELSE 'NULL'
                END 
                WHERE Reference = '$reference'";
                $results = $conn->query($updateQuery);
                // Send an email
                $sql = "SELECT * FROM tbl_inout WHERE Channel = 'PRESIDENT' AND Reference = '$reference' AND DocInOut = 'OUT'";
                $result = $conn->query($sql);
    
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $email = $row['Gmail'];
                    $remarks = $row['Remarks'];
                    $subjec = $row['Subject'];
                    $office = $row['Channel'];
                    $campus = $row['Campus'];
    
                    $subject = "Document Status Update in $office";
                    $message = "Salutations, campus of $campus.<br>
    
                    Please be aware that your document is pending and will be processed after it is finished and submitted in accordance with our established procedures.<br> Remarks : $remarks";
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
    
                        echo '<script>
                        document.addEventListener("DOMContentLoaded", function() {
                          var sweetAlertScript = document.createElement("script");
                          sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
                          document.head.appendChild(sweetAlertScript);
                        
                          sweetAlertScript.onload = function() {
                            swal({
                              title: "Update Successful",
                              text: "DISAPPROVED",
                              icon: "success",
                              buttons: false,
                              timer: 1200
                            }).then(function() {
                              window.location.href = "update";
                            });
                          };
                        });
                        </script>';
                            
                    
                }
        }
    }
}
?>