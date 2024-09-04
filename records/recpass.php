<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEUST DOCUMENT TRACKING</title>
</head>
<body>

<?php
include '../database.php';
include '../session.php';
include 'log.php';
$sql = "SELECT * FROM doctrack.tbl_users WHERE Office = 'RECORDS'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  $office = $row['Office'];
}

$_SESSION['allowedoffice'] = $office;
?>

    <!--Main Navigation-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


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

.table-container::-webkit-scrollbar {
    display: none; /* Chrome, Safari, and Opera */
}
* {
  overflow: hidden;
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
    background-color: gray !important;
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

    * {
  overflow: hidden;
}

.buttons {
  justify-content: space-between;
  display: flex;
}
  
    .title {
      display: flex;
      justify-content: space-between;
    } .title-sub{
        font-size: 30px;
    }

    .table-container::-webkit-scrollbar {
    display: none; /* Chrome, Safari, and Opera */
}
  </style>

<header>
    <!-- Sidebar -->
    <?php

$sql = "SELECT * FROM doctrack.tbl_users WHERE Office = 'RECORDS'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $imagePath = $row['Image'];
    $position = $row['Position'];
    $id = $row['ID'];
    $owner = $row['Owner'];

    echo '
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-primary text-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-2 mt-3">
          <a href="dashboard" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold" aria-current="true">
            <i class="bi bi-speedometer2 me-3"></i><span>Dashboard</span></a>

          <a href="send" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold">
            <i class="bi bi-folder-plus me-3 text-white"></i><span>New Document</span></a>

          <a href="updaterec" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold"
            ><i class="bi bi-file-earmark-break me-3 text-white"></i><span>Update Document</span></a>

          <a href="pendisrec" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold" aria-current="true">
            <i class="bi bi-card-list me-3"></i><span>Pending Document</span></a>

          <a href="comrec" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold">
            <i class="bi bi-card-checklist me-3 text-white"></i><span>Complete Document</span></a>

          <a href="arcrec" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold"
            ><i class="bi bi-archive me-3 text-white"></i><span>Stored Document</span></a>

          <a href="recarchive" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold" aria-current="true">
            <i class="bi bi-file-zip me-3"></i><span>Archived</span></a>

          <a href="backrec" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold">
            <i class="bi bi-cloud me-3 text-white"></i><span>Backup Document</span></a>

          <a href="" id="active" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold"
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
        <a class="navbar-brand" href="#">
            <img src="LOGO 1.png" alt="" style="height: 5vh;">
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
echo '<FORM action = "change_prof" method = "post" enctype="multipart/form-data">';
    echo '<div class="mx-4 px-2 pb-2">
        <div class="title">
            <div class="title-sub fw-bold">MY ACCOUNT</div>
          </div>
                    <div class="table-container mt-2">
                        <div class="row my-2 mx-3 mt-3">

                        <div class="row my-2 mx-3 my-3">
                        <h4>Profile Picture</h4>
                        <div class="col-2 mb-3 form">

                                <input type="hidden" value="'.$id.'" name="owner">
                                <img class="p-2" src="'.$imagePath.'" alt="" style="width:110px; border: 1px solid gray; border-radius: 5px;">
                              
                            </div>

                            <div class="col-8 mt-3">
                                <label for="" class="form-label">Choose Profile Picture</label>
                                <input type="file" class="form-control" name="image" id="" placeholder="" aria-describedby="fileHelpId" required/>
                            </div>

                            <div class="col-2 mt-2 text-center">
                            <button type="submit" class="btn btn-primary mt-5" name="save">
                                          <i class="bi bi-upload"></i> Upload Profile
                            </button>
                            </div>
                        
                        </div> </form>';

                        echo '<FORM action = "change_name" method = "post" onsubmit = "return ValidatePassword()" enctype = "multipart/form-data" name = "frmChangePass">
                        <div class="row my-2 mx-3 my-3">
                        <div class="buttons">
          <h4>Account Information</h4>
          
          <button type="button" class="btn btn-primary mx-5 mb-2" data-bs-toggle="modal" data-bs-target="#addAcc">
          <i class="bi bi-arrow-up-circle"></i>
          Update Account Information
          </button>
          </div>

          <div class="col-1 fw-bold col-form-label">Name</div>
              <div class="col-11 mb-2">
                  <input type="text" class="form-control" name="" id="" placeholder="'.$owner.'" disabled>
              </div>
             

              <div class="col-1 fw-bold col-form-label">Office</div>
              <div class="col-11 mb-2">
                  <input type="text" class="form-control" name="" id="" placeholder="'.$office.'" disabled>
              </div>

              <div class="col-1 fw-bold col-form-label">Position</div>
              <div class="col-11 mb-2">
                  <input type="text" class="form-control" name="" id="" placeholder="'.$position.'" disabled>
              </div>

              <div class="col-1 fw-bold col-form-label">Privillege</div>
              <div class="col-11 mb-2">
                  <input type="text" class="form-control" name="" id="" placeholder="'.$pri.'" disabled>
              </div>
              </form>
              </div>
              <FORM action = "changepass" method = "post" onsubmit = "return ValidatePassword()" enctype = "multipart/form-data" name = "frmChangePass">
              <div class="row mx-3 ">
              <div class="col-1 fw-bold col-form-label">Password</div>';
              
              echo "<INPUT type = 'hidden' value = '".$password."' name = 'password' id = 'currentpass'>";
              echo"<INPUT type = 'hidden' value = '".$username."' name = 'currentuser' id = 'currentuser'>";
              echo '
              <div class="col-11 mb-2">
                  <input type="password" class="form-control" name="currentpass" placeholder="Current Password" >
              </div>

              <div class="col-1 fw-bold col-form-label"></div>
              <div class="col-11 mb-2">
                  <input type="password" class="form-control" name="newpass" placeholder="New Password" >
              </div>

              <div class="col-1 fw-bold col-form-label"></div>
              <div class="col-11 mb-1">
                  <input type="password" class="form-control" name="confirmpass" placeholder="Confirm New Password" >
              </div>

          </div>

          </div>
          <div class="text-center">
          <INPUT type ="submit" value = "SAVE" name="save" class="btn btn-primary px-5" />
          </div>
          </form>
        </div>
</main>';
}

echo '
<div class="modal fade" id="addAcc" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">Account Information</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form action="change_name" method="POST" enctype="multipart/form-data">';

                          $query = "SELECT * FROM tbl_users WHERE Office = '$office'";
                          $result = $conn->query($query);
                          $numrows = $result->num_rows;
                          while ($rows = $result->fetch_assoc()) {

                          echo "<div class='id'>
                          <input type='hidden' name='id' value='". $rows['ID'] ."'>
                            </div>";
                          }

                              echo '<div class="mb-3 fw-bold">
                              <label for="recipient-name" class="col-form-label">Name<span class="text-danger"> *</span></label>
                              <input type="text" name="owner" class="form-control" placeholder="Owner" oninput="this.value = this.value.toUpperCase()" required>
                          </div>

                          <div class="mb-3 fw-bold">
                          <label for="recipient-name" class="col-form-label">Office<span class="text-danger"> *</span></label>
                          <input type="text" class="form-control" name="office" value="'.$office.'" placeholder="Office" oninput="this.value = this.value.toUpperCase()" disabled >
                          </div>  

                          <div class="mb-3 fw-bold">
                              <label for="recipient-name" class="col-form-label">Position<span class="text-danger"> *</span></label>
                              <input type="text" name="position" placeholder="Position" class="form-control" required>
                          </div>

                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" name="save">Save changes</button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
';

// update account information

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>