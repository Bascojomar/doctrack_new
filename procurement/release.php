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
$sql = "SELECT * FROM doctrack.tbl_users WHERE Office = 'PROCUREMENT'";
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

    .badge{
      width: 100px;
    }
    * {
  overflow: hidden;
}
*{
      font-family: arial;
    }
</style>

<header>
   
<!-- Sidebar -->
<?php

$sql = "SELECT * FROM doctrack.tbl_users WHERE Office = 'PROCUREMENT'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $imagePath = $row['Image'];
    $position = $row['Position'];
    $owner = $row['Owner'];
    echo '
<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-primary text-white">
  <div class="position-sticky">
    <div class="list-group list-group-flush mx-2 mt-3">

      <a href="dashboard" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold"
          ><i class="bi bi-speedometer2 me-3"></i><span>Dashboard</span></a>
  
        <a href="pro" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold" aria-current="true">
          <i class="bi bi-card-list me-3"></i><span>Receive Document</span></a>
  
        <a href="update" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold"
        ><i class="bi bi-file-earmark-break me-3 text-white"></i><span>Update Status</span></a>
  
        <a href="release" id="active" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold">
          <i class="bi bi-check2-square me-3 text-white"></i><span>Complete Document</span></a>

          <a href="propass"  class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold"
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
echo'
    <div class="mx-4 px-2 pb-2">
        <div class="title">
            <div class="title-sub fw-bold">COMPLETE DOCUMENTS</div>
            <!-- <div class="btn btn-primary pt-2" data-bs-toggle="modal" data-bs-target="#addAcc">
                Add Account
            </div> -->
          </div>';
          $queryload = "SELECT * FROM tbl_inout WHERE Channel = 'PROCUREMENT' and DocInOut = 'OUT' and DocStatus = 'COMPLETED' ORDER BY CDate DESC";
            $resultload = $conn->query($queryload);
            $numrowsload = $resultload->num_rows;
                    echo'<div class="table-container mt-2 px-3 pt-3">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                        <tr>';
                        echo "<TH class = 'text-center'>Tracking Number</TH>";
                        echo "<TH class = 'text-center'>Subject</TH>";
                        echo "<TH class = 'text-center'>Office Origin</TH>";
                        echo "<TH class = 'text-center'>Document Status</TH>";
                        echo ' <th class="text-center">View</th>';
                        echo'</tr>
                        </thead>
                        <tbody>';
                        while ($rowsload = $resultload->fetch_assoc()) 
                        {
                            echo "<TR class = 'text-center'>";
                            echo "<TD class = 'query'>".$rowsload["Reference"]."</TD>";
                            echo "<TD class = 'query'>".$rowsload["Subject"]."</TD>";
                            echo "<TD class = 'query'>".$rowsload["FromOffice"]."</TD>";
                            echo "<TD class = 'query'>".$rowsload["DocStatus"]."</TD>";
                            echo "<td class='query text-center'><a href=' " . $rowsload["new_upload"] . "'><i class='bi bi-eye btn btn-primary';'></i></a></td>";
                        echo'</tr>';
                        }
                    echo '</tbody
                    </table>
                    </div>
            
        </div>
</main>';
                        }
?>
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