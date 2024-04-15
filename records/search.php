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

$sql = "SELECT * FROM doctrack.tbl_users WHERE Office = '$office'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  $office = $row['Office'];

  $_SESSION['allowedoffice'] = $office;
}
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
        background-color: #F3F4F8 !important;
    }
    table {
      width: 97%;
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

    .col .card{
        height: 232px;
        margin-bottom: 10px;
    }

     .big .card{
        height: 475px;
        margin-bottom: 10px;
    }

    .card{
        background-color: #FCFCFC !important;
    }

    .on{
        opacity: 1;
        color: green !important;
    }

    .on_half{
        opacity: .7;
        color: orange !important;
    }

    .off{
        opacity: .2;
    }

    @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');

    @keyframes continuousFadeIn {
            0% {
                opacity: 0;
                transform: translateY(0px);
            }
            50% {
                opacity: 1;
                transform: translateY(0);
            }
            100% {
                opacity: 0;
                transform: translateY(0px);
            }
        }

        /* Apply styles to the card */
        .status {
            animation: continuousFadeIn 7s ease-in-out infinite; /* Apply the continuous animation */
            font-family: "Anton", sans-serif;
            font-weight: bold;
            font-style: normal;
            margin-top: 11vh;
        }
        * {
  overflow: hidden;
}
</style>

<header>
<!-- Sidebar -->
<?php

$sql = "SELECT * FROM doctrack.tbl_users WHERE Office = '$office'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $owner = $row['Owner'];
    $suffix = $row['Suffix'];
    $position = $row['Position'];
    $pri = $row['Privilege'];
    $imagePath = $row['Image'];
echo ' <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-primary text-white">
<div class="position-sticky">
  <div class="list-group list-group-flush mx-2 mt-3">
    <a href="dashboard" id="active" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold" aria-current="true">
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
<main>
    <div class="mx-4 px-2 pb-2">
    <div class="title">
    <div class="title-sub fw-bold">DOCUMENT TRACK AND TRACE</div>
    <div class="search-bar input-group" style="width: 250px;">';
    echo "<FORM action='search' method='post' onsubmit='return validateSearch();'>";
    echo '<div class="search-bar input-group" style="width: 250px;">
        <input type="text" class="form-control" name = "searchref" class = "searchinput" placeholder="NEUST***********"">
        <button class="btn btn-outline-secondary" type="submit" name="submit" id = "searchbuttonref">
            <i class="bi bi-search"></i> <!-- Bootstrap Icon for Search -->
        </button>
    </div>';
    echo "</FORM>";
    echo '</div>
</div>';
 
        echo '<div class="table-container mt-2">
            <!-- ROW FOR WHOLE  -->
        <div class="row mx-1 my-2 ms-4"> ';
        if (isset($_POST['submit'])) {
            // Assuming you have a valid database connection in $conn
            $searchRef = $_POST['searchref'];
    
            if (empty($searchRef)) {
                echo "<script>alert('Please Enter Reference Number')</script>";
                 echo "<script>window.location.href = 'dashboard'</script>";
            } else {
                $query = "SELECT * FROM tbl_inout WHERE Reference = '" . $searchRef . "' and DocStatus <> '-' LIMIT 1";
                $result = $conn->query($query);
                $numrows = $result->num_rows;

                if ($numrows > 0) {
                  while ($rows = $result->fetch_assoc()) {
            echo'
            <div class="row">
                <div class="col-6">
                    <div class="col col-12">
                        <div class="card text-start bg-danger text-dark">
                            <div class="card-body fw-semibold">
                                <h5 class="card-title mb-1 mt-1">Document Information</h5>
                                <div class="row">
                                    <div class="col col-5">Reference Number:</div>
                                    <div class="col col-5">';
                                    echo "<td class='infocells'><h3 id='referenceNumber'>" . $rows["Reference"] . "</h3></td> </div>";
                                    echo'<div class="col col-2"> <i class="bi bi-copy" style="cursor: pointer;" onclick="copyReference()"></i></div>
                                </div>
                                <div class="row">
                                    <div class="col col-5">Subject:</div>
                                    <div class="col col-6">';
                                    echo "<td class='infocells'><h3>" . $rows["Subject"] . "</h3></td>";
                                    echo'</div>
                                    <div class="col col-2"> </div>
                                </div>
                                <div class="row">
                                    <div class="col col-5">Office Origin:</div>
                                    <div class="col col-6">';
                                    echo "<td class='infocells'><h3>" . $rows["FromOffice"] . "</h3></td>";
                                    echo'</div>
                                    <div class="col col-2"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12">
                        <div class="card text-start bg-danger text-dark">
                            <div class="card-body fw-semibold text-center">
                                <h1 class="status">PROCESS DONE</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                <div class="col big col-12">
                    <div class="card text-start bg-warning text-dark">
                        <div class="card-body">
                            <h4 class="card-title mb-4 mt-3">Document status as follows</h4>';
                            $sql = "SELECT * FROM doctrack.tbl_inout WHERE Reference = '" . $searchRef . "' and DocInOut = 'IN' and Channel = 'RECORDS' LIMIT 1";
                            $result = $conn->query($sql);
                            
                            if ($result && $result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $docstatus_records = $row['DocStatus'];
                            
                                if ($docstatus_records == 'RECEIVED') {
                                    echo '<div class="row mb-3 on_half">
                                            <div class="col col-4 text-end">'.$rows['CDate'].' <br><span style="font-size: 12px;">10:00 AM</span></div>
                                            <div class="col col-1">
                                                <i class="bi bi-check-circle-fill"></i>
                                            </div>
                                            <div class="col col-7 text-start">Received by Records <br>
                                                Remarks : '.$rows['Remarks'].'</div>
                                        </div>';
                                } elseif ($docstatus_records== 'COMPLETED') {
                                    echo'<div class="row mb-3 on">
                                    <div class="col col-4 text-end">'.$rows['CDate'].' <br><span style="font-size: 12px;">12:04 PM</span></div>
                                    <div class="col col-1">
                                        <i class="bi bi-check-circle-fill"></i>
                                        </div>
                                    <div class="col col-7 text-start">Received by VPAA <br>
                                        Remarks : '.$rows['Remarks'].'</div>
                                </div>';
                                }else {
                                    echo '<div class="row mb-3 on_half">
                                            <div class="col col-4 text-end">'.$rows['CDate'].' <br><span style="font-size: 12px;">10:00 AM</span></div>
                                            <div class="col col-1">
                                                <i class="bi bi-check-circle-fill"></i>
                                            </div>
                                            <div class="col col-7 text-start">Received by Records <br>
                                                Remarks : '.$rows['Remarks'].'</div>';
                                }
                            }
                            
                            $sql = "SELECT * FROM doctrack.tbl_inout WHERE Reference = '" . $searchRef . "' and DocInOut = 'IN' and Channel = 'PROCUREMENT' LIMIT 1";
                            $result = $conn->query($sql);
                            
                            if ($result && $result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $docstatus_pro = $row['DocStatus'];

                            $sql = "SELECT * FROM doctrack.tbl_inout WHERE Reference = '" . $searchRef . "' and DocInOut = 'OUT' and Channel = 'PROCUREMENT' LIMIT 1";
                            $result = $conn->query($sql);
                            
                            if ($result && $result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $docstatus_pro1 = $row['DocStatus'];

                    if ($docstatus_pro == 'RECEIVED') {
                            echo'<div class="row mb-3 on_half">
                                <div class="col col-4 text-end">2'.$rows['CDate'].'<br><span style="font-size: 12px;">11:38 AM</span></div>
                                <div class="col col-1">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="col col-7 text-start">Received by PROCUREMENT <br>
                                    Remarks : '.$row['Remarks'].'</div>
                            </div>';
                        } elseif ($docstatus_pro1== 'RELEASED') {
                            echo'<div class="row mb-3 on">
                            <div class="col col-4 text-end">'.$rows['CDate'].' <br><span style="font-size: 12px;">12:04 PM</span></div>
                            <div class="col col-1">
                                <i class="bi bi-check-circle-fill"></i>
                                </div>
                            <div class="col col-7 text-start">Received by VPAA <br>
                                Remarks : '.$rows['Remarks'].'</div>
                        </div>';
                        }else {
                            echo'<div class="row mb-3 off">
                            <div class="col col-4 text-end">'.$rows['CDate'].'<br><span style="font-size: 12px;">11:38 AM</span></div>
                            <div class="col col-1">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="col col-7 text-start">Received by PROCUREMENT <br>
                                Remarks : '.$rows['Remarks'].'</div>
                        </div>';

                        }
                    }
                } 
                
                $sql = "SELECT * FROM doctrack.tbl_inout WHERE Reference = '" . $searchRef . "' and DocInOut = 'IN' and Channel = 'VPAA' LIMIT 1";
                            $result = $conn->query($sql);
                            
                            if ($result && $result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $docstatus_vpaa = $row['DocStatus'];

                $sql = "SELECT * FROM doctrack.tbl_inout WHERE Reference = '" . $searchRef . "' and DocInOut = 'OUT' and Channel = 'VPAA' LIMIT 1";
                            $result = $conn->query($sql);
                            
                            if ($result && $result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $docstatus_vpaa1 = $row['DocStatus'];

                if ($docstatus_vpaa == 'RECEIVED') {
                            echo'<div class="row mb-3 on_half">
                                <div class="col col-4 text-end">'.$rows['CDate'].' <br><span style="font-size: 12px;">12:04 PM</span></div>
                                <div class="col col-1">
                                    <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                <div class="col col-7 text-start">Received by VPAA <br>
                                    Remarks : '.$rows['Remarks'].'</div>
                            </div>';
                        }
                        
                        elseif ($docstatus_vpaa1== 'RELEASED') {
                            echo'<div class="row mb-3 on">
                            <div class="col col-4 text-end">'.$rows['CDate'].' <br><span style="font-size: 12px;">12:04 PM</span></div>
                            <div class="col col-1">
                                <i class="bi bi-check-circle-fill"></i>
                                </div>
                            <div class="col col-7 text-start">Received by VPAA <br>
                                Remarks : '.$rows['Remarks'].'</div>
                        </div>';
                        }else{
                            echo'<div class="row mb-3 off">
                            <div class="col col-4 text-end">'.$rows['CDate'].'<br><span style="font-size: 12px;">11:38 AM</span></div>
                            <div class="col col-1">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="col col-7 text-start">Received by Records <br>
                                Remarks : '.$rows['Remarks'].'</div>
                        </div>';

                        }
                }

            }
                $sql = "SELECT * FROM doctrack.tbl_inout WHERE Reference = '" . $searchRef . "' and DocInOut = 'IN' and Channel = 'VPABM' LIMIT 1";
                            $result = $conn->query($sql);
                            
                            if ($result && $result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $docstatus_vpabm = $row['DocStatus'];

                $sql = "SELECT * FROM doctrack.tbl_inout WHERE Reference = '" . $searchRef . "' and DocInOut = 'OUT' and Channel = 'VPABM' LIMIT 1";
                            $result = $conn->query($sql);
                            
                            if ($result && $result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $docstatus_vpabm1 = $row['DocStatus'];

                if ($docstatus_vpabm == 'RECEIVED') {
                            echo'<div class="row mb-3 on_half">
                                <div class="col col-4 text-end">'.$rows['CDate'].'<br><span style="font-size: 12px;">12:04 PM</span></div>
                                <div class="col col-1">
                                    <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                <div class="col col-7 text-start">Received by VPABM <br>
                                    Remarks : '.$rows['Remarks'].'</div>
                            </div>';
                        }
                        elseif ($docstatus_vpabm1== 'RELEASED') {
                            echo'<div class="row mb-3 on">
                            <div class="col col-4 text-end">'.$rows['CDate'].' <br><span style="font-size: 12px;">12:04 PM</span></div>
                            <div class="col col-1">
                                <i class="bi bi-check-circle-fill"></i>
                                </div>
                            <div class="col col-7 text-start">Received by VPAA <br>
                                Remarks : '.$rows['Remarks'].'</div>
                        </div>';
                        }else{
                            echo'<div class="row mb-3 off">
                            <div class="col col-4 text-end">'.$rows['CDate'].'<br><span style="font-size: 12px;">11:38 AM</span></div>
                            <div class="col col-1">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="col col-7 text-start">Received by VPABM <br>
                                Remarks : '.$rows['Remarks'].'</div>
                        </div>';

                        }
                }
            }
                    $sql = "SELECT * FROM doctrack.tbl_inout WHERE Reference = '" . $searchRef . "' and DocInOut = 'IN' and Channel = 'VPRET' LIMIT 1";
                    $result = $conn->query($sql);
                    
                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $docstatus_vpret = $row['DocStatus'];

                    $sql = "SELECT * FROM doctrack.tbl_inout WHERE Reference = '" . $searchRef . "' and DocInOut = 'OUT' and Channel = 'VPRET' LIMIT 1";
                    $result = $conn->query($sql);
                    
                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $docstatus_vpret1 = $row['DocStatus'];

                            if ($docstatus_vpret == 'RECEIVED') {
                            echo'<div class="row mb-3 on_half">
                                <div class="col col-4 text-end">'.$rows['CDate'].'<br><span style="font-size: 12px;">3:00 PM</span></div>
                                <div class="col col-1">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="col col-7 text-start">Received by VPRET <br>
                                    Remarks : '.$rows['Remarks'].'</div>
                            </div>';
                        }
                        elseif ($docstatus_vpret1== 'RELEASED') {
                            echo'<div class="row mb-3 on">
                            <div class="col col-4 text-end">'.$rows['CDate'].' <br><span style="font-size: 12px;">12:04 PM</span></div>
                            <div class="col col-1">
                                <i class="bi bi-check-circle-fill"></i>
                                </div>
                            <div class="col col-7 text-start">Received by VPAA <br>
                                Remarks : '.$rows['Remarks'].'</div>
                        </div>';
                        } else{
                            echo'<div class="row mb-3 off">
                            <div class="col col-4 text-end">'.$rows['CDate'].'<br><span style="font-size: 12px;">11:38 AM</span></div>
                            <div class="col col-1">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="col col-7 text-start">Received by VPRET <br>
                                Remarks : '.$rows['Remarks'].'</div>
                        </div>';

                        }
                }
            }
                $sql = "SELECT * FROM doctrack.tbl_inout WHERE Reference = '" . $searchRef . "' and DocInOut = 'IN' and Channel = 'PRESIDENT' LIMIT 1";
                    $result = $conn->query($sql);
                    
                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $docstatus_pres = $row['DocStatus'];

                $sql = "SELECT * FROM doctrack.tbl_inout WHERE Reference = '" . $searchRef . "' and DocInOut = 'OUT' and Channel = 'PRESIDENT' LIMIT 1";
                    $result = $conn->query($sql);
                    
                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $docstatus_pres1 = $row['DocStatus'];

                            if ($docstatus_pres== 'RECEIVED') {
                            echo'<div class="row mb-3 on_half">
                                <div class="col col-4 text-end">'.$rows['CDate'].'<br><span style="font-size: 12px;">3:00 PM</span></div>
                                <div class="col col-1">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="col col-7 text-start">Received by PRESIDENT <br>
                                    Remarks : '.$rows['Remarks'].'</div>
                            </div>';
                        }
                        elseif ($docstatus_pres1 == 'RELEASED') {
                            echo'<div class="row mb-3 on">
                            <div class="col col-4 text-end">'.$rows['CDate'].' <br><span style="font-size: 12px;">12:04 PM</span></div>
                            <div class="col col-1">
                                <i class="bi bi-check-circle-fill"></i>
                                </div>
                            <div class="col col-7 text-start">Received by VPAA <br>
                                Remarks : '.$rows['Remarks'].'</div>
                        </div>';
                        } else{
                            echo'<div class="row mb-3 off">
                            <div class="col col-4 text-end">'.$rows['CDate'].' <br><span style="font-size: 12px;">11:38 AM</span></div>
                            <div class="col col-1">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="col col-7 text-start">Received by PRESIDENT <br>
                                Remarks : '.$rows['Remarks'].'</div>
                        </div>';

                        }
                    }
                }
                        echo'</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col col-6">
            <div class="card text-start bg-success text-white">
                <div class="card-body">
                    <h4 class="card-title">Complete Documents</h4>
                    <h5 class="card-text">3</h5>
                </div>
            </div>
        </div> -->
    </div>
    </div>
        
    </div>
</main>';
                  }
                }
            }
        }
}
?>

<script>
function copyReference() {
    var referenceNumber = document.getElementById("referenceNumber").innerText;
    var tempInput = document.createElement("input");
    tempInput.value = referenceNumber;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);

    var notification = document.createElement("div");
    notification.innerHTML = "copied";
    notification.style.cssText = "position: fixed; top: 37%; left: 53%; transform: translate(-50%, -50%); background-color: #ffffff; padding: 10px; border: 1px solid gary; z-index: 9999";
    document.body.appendChild(notification);
    setTimeout(function(){
        notification.style.display = "none";
    }, 2000); // Adjust the time for how long you want to display the notification (in milliseconds)

}
</script>
 <script>
        document.getElementById("copyIcon").addEventListener("click", function() {
            // Text to copy
            var textToCopy = "Your text goes here";

            // Create a temporary input element
            var tempInput = document.createElement("input");
            tempInput.setAttribute("value", textToCopy);
            document.body.appendChild(tempInput);

            // Select the text
            tempInput.select();
            tempInput.setSelectionRange(0, 99999); /* For mobile devices */

            // Copy the text to the clipboard
            document.execCommand("copy");

            // Remove the temporary input
            document.body.removeChild(tempInput);

            // Alert the user that the text has been copied
            alert("Text copied to clipboard: " + textToCopy);
        });
    </script>
<!--Main layout-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" integrity="sha384-BNL3+R/wV+lY8dTlyryAO/b4mvjqKp1pSVsjv3IVyC1vQCZBM4B2L2eKJP5h/gjv" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>