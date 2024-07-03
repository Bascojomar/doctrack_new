
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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


if (isset($_POST['archive'])) {
  // Handle the archiving logic
  $reference = $_POST['reference'];
  $received = $_POST['received'];
  $contact = $_POST['contact'];

  // Prepare the update query with a prepared statement to prevent SQL injection
  $updateQuery = "UPDATE tbl_inout SET DocStatus = 'STORED', Received = ?, Contact = ?, time = NOW() WHERE Reference = ?";
  $stmt = $conn->prepare($updateQuery);
  $stmt->bind_param("sss", $received, $contact, $reference);
  

  // Set the document status for the update
  $docStatus = 'STORED';

  // Execute the update query
  if ($stmt->execute()) {
      // Update successful
      echo '<script>
          document.addEventListener("DOMContentLoaded", function() {
              var sweetAlertScript = document.createElement("script");
              sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
              document.head.appendChild(sweetAlertScript);
          
              sweetAlertScript.onload = function() {
                  swal({
                      title: "Update Successful",
                      text: "STORED",
                      icon: "success",
                      buttons: false,
                      timer: 1200
                  }).then(function() {
                      window.location.href = "comrec";
                  });
              };
          });
      </script>';

      // Select relevant information for the email notification
      $sql = "SELECT * FROM tbl_inout WHERE Reference = ? AND DocInOut = 'IN'";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $reference);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result && $result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $email = $row['Gmail'];
          $office = $row['Channel'];
          $subject = "Document Status Update in $office";
          $message = "Greetings<br>Your document is now on hand of $received.";

          // Send email notification
          require 'path/to/PHPMailerAutoload.php'; // Make sure to adjust the path
          $mail = new PHPMailer(true);
          // Configure PHPMailer
          // ...
          // Send email
          $mail->send();
      }
  } else {
      // Update failed
      echo "Error updating record: " . $conn->error;
  }

  // Close statement and connection
  $stmt->close();
  $conn->close();
}



$_SESSION['allowedoffice'] = $office;


echo "<DIV>";
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
    background: linear-gradient(to left, #0E2A7D, white) !important;
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
    background-color:#0E2A7D !important;
}
#sidebarMenu a{
    background-color:#0E2A7D !important;
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

    .table-container::-webkit-scrollbar {
    display: none; /* Chrome, Safari, and Opera */
}
* {
  overflow: hidden;
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

<?php

$sql = "SELECT * FROM doctrack.tbl_users WHERE Office = 'RECORDS'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $imagePath = $row['Image'];
    $position = $row['Position'];
    $owner = $row['Owner'];
    echo '
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-primary text-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-2 mt-3">
          <a href="dashboard"  class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold" aria-current="true">
            <i class="bi bi-speedometer2 me-3"></i><span>Dashboard</span></a>

          <a href="send"  class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold">
            <i class="bi bi-folder-plus me-3 text-white"></i><span>New Document</span></a>

          <a href="updaterec"  class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold"
            ><i class="bi bi-file-earmark-break me-3 text-white"></i><span>Update Document</span></a>

          <a href="pendisrec" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold" aria-current="true">
            <i class="bi bi-card-list me-3"></i><span>Pending Document</span></a>

          <a href="comrec" id="active" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold">
            <i class="bi bi-card-checklist me-3 text-white"></i><span>Complete Document</span></a>

          <a href="arcrec" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold"
            ><i class="bi bi-archive me-3 text-white"></i><span>Stored Document</span></a>

          <a href="recarchive" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold" aria-current="true">
            <i class="bi bi-file-zip me-3"></i><span>Archived</span></a>

          <a href="backrec" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold">
            <i class="bi bi-cloud me-3 text-white"></i><span>Backup Document</span></a>

          <a href="recpass" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold"
            ><i class="bi bi-person me-3 text-white"></i><span>My Account</span></a>

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
            <div class="d-flex align-items-center">
            <img
            src="' . $imagePath .'"
            class="rounded-circle"
            style="height: 9vh;width: 9vh;"
        />
                <img src="../file/logos.png" class=" rounded-circle"
                style="height: 9vh; position: absolute;"/>
                <div class="d-flex flex-column mx-2">
                    <p class="text-white fw-semibold mb-0">
                        '.$owner.'
                    </p>
                    <span class="text-white" style="font-size: smaller; margin-top: -5px;">'.$position.'</span>
                </div>
            </div>
        </ul>
        </div>
    <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
<main>';
    echo '<div class="mx-4 px-2 pb-2">
        <div class="title">
            <div class="title-sub fw-bold">COMPLETE DOCUMENTS</div>
            <!-- <div class="btn btn-primary pt-2" data-bs-toggle="modal" data-bs-target="#addAcc">
                Add Account
            </div> -->
            <div class="modal fade" id="addAcc" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="mb-3 fw-bold">
                        <label for="recipient-name" class="col-form-label">Owner<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="e.g. Juan Dela Cruz">
                      </div>
                      <div class="mb-3 fw-bold">
                        <label for="recipient-name" class="col-form-label">Position<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="e.g. Admin">
                      </div>
                      <div class="mb-3 fw-bold">
                        <label for="recipient-name" class="col-form-label">Username<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="e.g. JuanCruz">
                      </div>
                      <div class="mb-3 fw-bold">
                        <label for="recipient-name" class="col-form-label">Password<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="e.g. *******">
                      </div>
                      <div class="mb-3 fw-bold">
                        <luffabel for="recipient-name" class="col-form-label">Email<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="e.g. juancruz@gmail.com">
                      </div>
                      <div class="mb-3 fw-bold">
                        <luffabel for="recipient-name" class="col-form-label">Office<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="e.g. MIS">
                      </div>
                      <div class="mb-3 fw-bold">
                        <luffabel for="recipient-name" class="col-form-label">Campus<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="e.g. Sumacab Este">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="table-container mt-2 p-3">
          <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                        <tr>';
                        echo "<TR class = 'queryrows'>";
                        echo "<TH class = 'query'>Calendar Date</TH>";
                        echo "<TH class = 'query'>Tracking Number</TH>";
                        echo "<TH class = 'query'>Campus</TH>";
                        echo "<TH class = 'query'>Form Office</TH>";
                        echo "<TH class = 'query'>Subject</TH>";
                        echo "<TH class = 'query'>Document Status Origin</TH>";
                        echo "<TH class = 'query'>Received by</TH>";
                        echo '</tr>
                        </thead>
                        <tbody>';
                        $queryload = "SELECT * FROM tbl_inout WHERE Channel = 'RECORDS' and DocStatus = 'COMPLETED' ORDER BY CDate DESC";
                        $resultload = $conn->query($queryload);
                        
                        if ($resultload->num_rows > 0) {
                            while ($rowsload = $resultload->fetch_assoc()) {
                                $from = strtotime($rowsload["CDate"]);
                                $today = time();
                                $difference = floor(($today - $from) / 86400);
                        echo'<tr>';
                        echo "<td class='querycells'>" . $rowsload["CDate"] . "</td>";
                        echo "<td class='querycells'>" . $rowsload["Reference"] . "</td>";
                        echo "<TD class = 'querycells'>".$rowsload["Campus"]."</TD>";
                        echo "<td class='querycells'>" . $rowsload["FromOffice"] . "</td>";
                        echo "<td class='querycells'>" . $rowsload["Subject"] . "</td>";
                        echo "<td class='querycells'>" . $rowsload["DocStatus"] . "</td>";
                            echo "<TD class='querycells'>";
                            echo '<div class="text-center" data-bs-toggle="modal" data-bs-target="#update">';
                            echo "<button type='button' class='update-button btn btn-danger' data-reference='" . $rowsload['Reference'] . "' value='Update'>
                                <i class='bi bi-pencil-square'></i>
                                </button> </div>";
                            echo "</TD>";
                                echo'</div>
                              </div>
                        </tr>
                        </tbody
                    </table>
                    </div>
            
        </div>
</main>';
}
                        }

                        echo '<div class="modal fade" id="update" tabindex="-1">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Update Document Status</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">';
      echo"<FORM action='comrec' method='post'>";

        echo "<div class='reference'>
        <input type='hidden' name='reference' value='". $rowsload['Reference'] ."'>
          </div>";
        
        echo'<div class="mb-3 fw-bold">
          <label for="recipient-name" class="col-form-label">Fullname:</label>';
          echo "<INPUT type='text' name ='received' class='form-control' placeholder='Fullname' required>";
        echo'</div>
        <div class="mb-3 fw-bold">
          <label for="recipient-name" class="col-form-label">Contact</label>
          <input type="number" name="contact" class="form-control" placeholder="09XX-XXX-XXXX" required>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <input type="submit" class="btn btn-success" name="archive">
    </div>
  </div>
  </form>
</div>
</div>
</div>';
                    }

?>
<!--Main layout-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" integrity="sha384-BNL3+R/wV+lY8dTlyryAO/b4mvjqKp1pSVsjv3IVyC1vQCZBM4B2L2eKJP5h/gjv" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
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


  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>
</body>
</html>