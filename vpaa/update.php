<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEUST DOCUMENT TRACKING</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>

<?php
include '../database.php';
include '../session.php';
include 'log.php';
$sql = "SELECT * FROM doctrack.tbl_users WHERE Office = '$office'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  $office = $row['Office'];
}

$_SESSION['allowedoffice'] = $office;
?>


    <!--Main Navigation-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    body {
  background-color: #fbfbfb;
}
@media (min-width: 991.98px) {
  main {
    padding-left: 240px;
  }
}

.navbar{
    background: gray !important;
}

/* Sidebar */
.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  padding: 10vh 0 0; /* Height of navbar */
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
  width: 240px;
  z-index: 600;
}

@media (max-width: 991.98px) {
  .sidebar {
    width: 40%;
    display: none; /* Initially hide the sidebar on smaller screens */
  }
  main{
    margin-top:10vh;
  }
}

.sidebar .active {
  border-radius: 5px;
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}

#sidebarMenu{
    background-color: white !important;
}
#sidebarMenu a{
    background-color: black !important;
    margin-bottom: .5vh;
    border-bottom: none;
}
#sidebarMenu a:hover{
    background: linear-gradient(to right, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0));
    border-radius: 3px 3px 3px 3px;
}

.mx-4{
    margin-top:12.5vh;
}

#active{
    background: linear-gradient(to right, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0));
    border-radius: 3px 3px 3px 3px;
}

#sidebarMenu i{
    font-size: 20px;
}

.table-container {
        height: 78vh; /* Fixed height */
        overflow-y: auto;
        border: 1px solid #ccc; /* Add border */
        border-radius: 4px; /* Add border radius */
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid #ddd;
    }
    th, td {
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #e9e9e9;
      position: sticky;
      top: 0;
    }

    .title {
      display: flex;
      justify-content: space-between;
    } .title-sub{
        font-size: 30px;
    }

    button {
    border: none;
    background: none; /* Optional: Removes any background color */
    padding: 0; /* Optional: Remove any default padding */
    font-size: 1.7em;
  }

  .querycells {
    text-align: center;
  }
</style>

<header>
    <!-- Sidebar -->
    <?php

$sql = "SELECT * FROM doctrack.tbl_users WHERE Office = '$office'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $imagePath = $row['Image'];
    $position = $row['Position'];
    $owner = $row['Owner'];
    echo '<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-primary text-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-2 mt-3">
  
        <a href="dashboard" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold"
          ><i class="bi bi-speedometer2 me-3"></i><span>Dashboard</span></a>
  
        <a href="vpaa1" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold" aria-current="true">
          <i class="bi bi-card-list me-3"></i><span>Receive Document</span></a>
  
        <a href="update" id="active" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold"
        ><i class="bi bi-file-earmark-break me-3 text-white"></i><span>Update Status</span></a>
  
        <a href="release" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold">
          <i class="bi bi-check2-square me-3 text-white"></i><span>Release Document</span></a>

          <a href="account" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold">
          <i class="bi bi-check2-square me-3 text-white"></i><span>My Account</span></a>
  
          <a href="../logout" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white"
          ><i class="bi bi-box-arrow-right me-3 text-white"></i><span>Logout</span></a>
      <div class="nav-item order-2 order-lg-1 d-none d-lg-block">
          <img src="texture_2.png" alt="" style="width: 100vh; position: relative; left: -69vh; opacity: 25%;">
      </div>
      </div>
  </div>
  </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
        <!-- Toggle button -->
        <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#sidebarMenu"
            aria-controls="sidebarMenu"
            aria-expanded="false"
            aria-label="Toggle navigation"
            onclick="toggleSidebar()"
        >
        <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand my-auto d-flex flex-row" href="#">

        </a>

        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row align-items-center">
        <!-- Avatar -->

            <div class="d-flex flex-column mx-2">
                <p class="text-white fw-semibold mb-0">
                    '.$owner.'
                </p>
                <span class="text-white" style="font-size: smaller;">'.$position.'</span>
            </div>
        </div>
    </ul>
        
        
        
        
    </div>
    <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
<main>';
echo'
    <div class="mx-4 px-2 pb-2">
        <div class="title">
            <div class="title-sub fw-bold">UPDATE DOCUMENTS</div>
            
          </div>';
          $query = "SELECT * FROM tbl_inout WHERE Channel = 'VPAA' AND DocStatus = 'RECEIVED' ORDER BY CDate DESC";
            $result = $conn->query($query);
            $numrows = $result->num_rows;
            echo '<div class="table-container mt-2 px-3 pt-3">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th class="query">Tracking Number</th>
                        <th class="query">Date</th>
                        <th class="query">Campus</th>
                        <th class="query">Office Origin</th>
                        <th class="query">Subject</th>
                        <th class="query">Document Status</th>
                        <th class="query">Days Idle</th>
                        <th class="query">Remarks</th>
                        <th class="query">View</th>
                        <th class="query">Download</th>
                        <th class="query">Update</th>
                    </tr>
                </thead>
                <tbody>';
        
        while ($rows = $result->fetch_assoc()) {
            $from = strtotime($rows["CDate"]);
            $today = time();
            $difference = floor(($today - $from) / 86400);
            $currentDate = date("Y/m/d");
        
            echo '<tr>';
            echo '<td class="query">' . $rows["Reference"] . '</td>';
            echo '<td class="query">' . $currentDate . '</td>';
            echo '<td class="query">' . $rows["Campus"] . '</td>';
            echo '<td class="query">' . $rows["FromOffice"] . '</td>';
            echo '<td class="query">' . $rows["Subject"] . '</td>';
            echo '<td class="query">' . $rows["DocStatus"] . '</td>';
            echo '<td class="query">' . $difference . '</td>';
            echo '<td class="query">' . $rows["PresidentRemarks"] . '</td>';
            echo "<td class='query text-center'><a href=' " . $rows["Upload"] . "'><i class='bi bi-eye btn btn-primary';'></i></a></td>";
    echo "<TD class='query'>";
    echo "<DIV class='sub'>";
    if ($rows["Upload"]) {
        echo "<FORM action='download' method='post'>";
        echo "<INPUT type='hidden' name='id' value='" . $rows['ID'] . "'>";
        echo "<div class='text-center'>
        
        <button class='btn btn-success' type='submit' name='download_file'>
        <i class='bi bi-download'></i>
        </button> </div>";
        echo "</FORM>";
    }
    echo "</TD>";
    echo "<TD class='querycells'>";
    echo '<div class="text-center" data-bs-toggle="modal" data-bs-target="#update">';
    echo "<button type='button' class='update-button btn btn-danger' data-reference='" . $rows['Reference'] . "' value='Update'>
        <i class='bi bi-pencil-square'></i>
        </button> </div>";
    echo "</TD>";
            echo '</tr>';
        }
        
        echo '</tbody>
            </table>
                    </div>
            
        </div>
</main>';
echo '<div class="modal fade" id="update" tabindex="-1">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Update Document Status</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">';
      echo"<FORM method='post' action='' enctype='multipart/form-data'>";

        echo "<div class='reference'>
        <input type='hidden' name='reference' value='". $rows['Reference'] ."'>
          </div>";
        
        echo'<div class="mb-3 fw-bold">
          <label for="recipient-name" class="col-form-label">Action Taken :</label>';
             echo "<select name='action' id ='action' onchange = 'Action(this.value)' class='form-control' required>
                    <option value='' disabled selected>Action Taken</option>
                    <option value='APPROVED'>APPROVED</option>
                    <option value='PENDING'>PENDING</option>
                    <option value='DISAPPROVED'>DISAPPROVED</option>
                  </select>";
        echo'</div>
        <div class="mb-3 fw-bold">
          <label for="recipient-name" class="col-form-label">Remarks :</label>
          <input type="text" name="remarks" class="form-control">
        </div>
        <div class="mb-3 fw-bold">
          <label for="recipient-name" class="col-form-label">Signed File :</label>
          <input type="file" name="new_upload" class="form-control" accept="application/pdf" required>
        </div>
        <div class="mb-3 fw-bold">
          <label for="recipient-name" class="col-form-label">Document Status :</label>';
          echo "
          <select name='doc' id ='doc' class='form-control' required>
          	   <option value='' disabled selected>Status</option>
          	   <option value='RELEASED'>RELEASED</option>
             </select>";
        echo '</div>
      
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <input type="submit" class="btn btn-success" name="dateup">
    </div>
  </div>
  </form>
</div>
</div>
</div>';
}

// modal function update
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


if (isset($_POST['dateup'])) {
    $reference = $_POST['reference'];
    $action = $_POST['action'];
    $remarks = $_POST['remarks'];
    $doc = $_POST['doc'];

    if (isset($_FILES["new_upload"]["name"])) {
      if (isset($_FILES["new_upload"]) && $_FILES["new_upload"]["error"] == UPLOAD_ERR_OK) {
        $uploadDir = "../file/";
        $uploadFile = $uploadDir . basename($_FILES["new_upload"]["name"]);
    
        if (move_uploaded_file($_FILES["new_upload"]["tmp_name"], $uploadFile)) {
            // File uploaded successfully, now update database
            $uploadValue = $uploadFile;
    
            $updateQuery = "UPDATE tbl_inout SET ActionTaken = '$action', Remarks = '$remarks', DocStatus = '$doc', new_upload = '$uploadValue' WHERE Channel = 'VPAA' AND Reference = '$reference' AND DocInOut = 'OUT'";
            $result = $conn->query($updateQuery);

    
    $updateQuery = "UPDATE tbl_inout SET ActionTaken = '$action', Remarks = '$remarks', DocStatus = CASE 
    WHEN Channel = 'VPAA' AND DocInOut = 'OUT' THEN 'RELEASED'
    ELSE '-'
  END 
  WHERE Reference = '$reference' and Channel='VPAA'";
  $results = $conn->query($updateQuery);
    

    if ($result) {
      
        if ($doc === 'RELEASED') {

            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
              var sweetAlertScript = document.createElement("script");
              sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
              document.head.appendChild(sweetAlertScript);
            
              sweetAlertScript.onload = function() {
                swal({
                  title: "Update Successful",
                  text: "RELEASED",
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
              WHEN Channel = 'VPAA' AND DocInOut = 'IN' THEN 'DISAPPROVED'
              ELSE '-'
            END 
            WHERE Reference = '$reference'";
            $results = $conn->query($updateQuery);
                // Send an email
                $sql = "SELECT * FROM tbl_inout WHERE Channel = 'VPAA' AND Reference = '$reference' AND DocInOut = 'OUT'";
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
                  ELSE '-'
                END 
                WHERE Reference = '$reference'";
                $results = $conn->query($updateQuery);
                // Send an email
                $sql = "SELECT * FROM tbl_inout WHERE Channel = 'VPAA' AND Reference = '$reference' AND DocInOut = 'OUT'";
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
	<script>
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("updateModal");
    const closeModal = document.querySelector(".closeModal"); // Change to querySelector
    const updateButtons = document.querySelectorAll(".update-button");
    const referenceInput = document.querySelector(".reference input");
    
    // Event listener for clicking an "Update" button
    updateButtons.forEach(button => {
        button.addEventListener("click", () => {
            // Get the reference number from the data attribute of the clicked button
            const reference = button.getAttribute("data-reference");
            
            // Populate the reference input field in the modal with the reference number
            referenceInput.value = reference;

            // Show the modal
            modal.classList.add("show-modal");
        });
    });

    // Event listener for clicking the close button
    closeModal.addEventListener("click", () => {
        modal.classList.remove("show-modal");
    });
});

function Action(selectedValue) {
  var docSelect = document.getElementById('doc');
  if (selectedValue === 'DISAPPROVED') {
    // If "DISAPPROVED" is selected, update the options in the "DocStatus" dropdown.
    docSelect.innerHTML = '<option value="DISAPPROVED">DISAPPROVED</option>';
  } else {
    // Reset the "DocStatus" dropdown to its default options.
    docSelect.innerHTML = '<option value="" disabled selected>Status</option>' +
                         '<option value="RELEASED">RELEASED</option>';
  }
}

function Action(selectedValue) {
  var docSelect = document.getElementById('doc');
  if (selectedValue === 'PENDING') {
    // If "DISAPPROVED" is selected, update the options in the "DocStatus" dropdown.
    docSelect.innerHTML = '<option value="PENDING">PENDING</option>';
  } else {
    // Reset the "DocStatus" dropdown to its default options.
    docSelect.innerHTML = '<option value="" disabled selected>Status</option>' +
                         '<option value="RELEASED">RELEASED</option>';
  }
}
</script>
<!--Main layout-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" integrity="sha384-BNL3+R/wV+lY8dTlyryAO/b4mvjqKp1pSVsjv3IVyC1vQCZBM4B2L2eKJP5h/gjv" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    // console.log("Document ready!"); // Check if this line appears in the console
    $('#example').DataTable();
  });
</script>
</body>
</html>