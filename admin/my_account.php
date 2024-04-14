<?php
include '../database.php';
include '../session.php';
include 'log.php';

$sql = "SELECT * FROM doctrack.tbl_users WHERE Office = 'SITE ADMIN'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  $office = $row['Office'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEUST DOCUMENT TRACKING</title>
</head>
<body>
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
  
    .title {
      display: flex;
      justify-content: space-between;
    } .title-sub{
        font-size: 30px;
    }

    .table-container::-webkit-scrollbar {
    display: none; /* Chrome, Safari, and Opera */
}
* {
  overflow: hidden;
}
.table-container::-webkit-scrollbar {
    display: none; /* Chrome, Safari, and Opera */
}
*{
      font-family: arial;
    }
  </style>

<header>
<?php

$sql = "SELECT * FROM doctrack.tbl_users WHERE Office = 'SITE ADMIN'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $owner = $row['Owner'];
    $suffix = $row['Suffix'];
    $position = $row['Position'];
    $pri = $row['Privilege'];
    $imagePath = $row['Image'];

    include 'nav.php';
echo '<!-- Navbar -->
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
    <main>
    ';
    echo '<FORM action = "changepass" method = "post" onsubmit = "return ValidatePassword()" enctype = "multipart/form-data" name = "frmChangePass">';
    echo '<div class="mx-4 px-2 pb-2">
        <div class="title">
            <div class="title-sub fw-bold">MY ACCOUNT</div>
          </div>
                    <div class="table-container mt-2">
                        <div class="row my-2 mx-3 mt-3">

                        <div class="row my-2 mx-3 my-3">
                        <h4>Profile Picture</h4>
                        <div class="col-2 mb-3 form">
                                <img class="p-2" src="'.$imagePath.'" alt="" style="width:110px; border: 1px solid gray; border-radius: 5px;">
                              
                            </div>

                            <div class="col-8 mt-3">
                                <label for="" class="form-label">Choose Profile Picture</label>
                                <input type="file" class="form-control" name="image" id="" placeholder="" aria-describedby="fileHelpId"/>
                            </div>

                            <div class="col-2 mt-2 text-center">
                            <button type="submit" class="btn btn-primary mt-5" name="approved">
                                          <i class="bi bi-upload"></i> Upload Profile
                            </button>
                            </div>
                        
                        </div>

                        <div class="row my-2 mx-3 my-3">
                        <h4>Account Information</h4>
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
        </div>
</main>
';
}
?>
</body>
</html>