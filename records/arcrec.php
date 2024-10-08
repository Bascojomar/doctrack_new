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

// Automatically archive files older than 10 seconds
$sql_auto_archive = "UPDATE tbl_inout SET DocStatus = 'ARCHIVED' WHERE DocStatus = 'STORED' AND TIMESTAMPDIFF(SECOND, time, NOW()) > 10";
$conn->query($sql_auto_archive);


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

    .title {
      display: flex;
      justify-content: space-between;
    } .title-sub{
        font-size: 30px;
    }

    .auto-shrink {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        @media print{
        button{
            display:none;
        }
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

          <a href="" id="active" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold"
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
            <div class="title-sub fw-bold">STORED DOCUMENTS</div>
 
          </div>';

                    echo'<div class="table-container mt-2">
                    <div id="searchstatus">
                    <table>
                        <thead>
                        <tr>
                            <th class="auto-shrink">Date</th>
                            <th class="auto-shrink">Tracking Number</th>
                            <th class="auto-shrink">Campus</th>
                            <th class="auto-shrink">From Office</th>
                            <th class="auto-shrink">Subject</th>
                            <th class="auto-shrink">Document Status Origin</th>
                            <th class="auto-shrink">View By</th>
                            <th class="auto-shrink">Recieved By</th>
                            <!-- <th class="text-center">Action</th> -->
                        </tr>
                        </thead>
                        <tbody>';
                        $queryload = "SELECT * FROM tbl_inout 
                        -- WHERE Channel IN ('PROCUREMENT', 'VPAA', 'VPRET', 'VPABM', 'PRESIDENT', 'RECORDS') 
                        -- AND DocStatus IN ('STORED') 
                        ORDER BY CDate DESC";
                        $resultload = $conn->query($queryload);
                        
                        if ($resultload->num_rows > 0) {
                            while ($rowsload = $resultload->fetch_assoc()) {
                                $from = strtotime($rowsload["CDate"]);
                                $today = time();
                                $difference = floor(($today - $from) / 86400);
                        echo '<tr>';
                        echo "<td class='auto-shrink'>" . $rowsload["CDate"] . "</td>";
                        echo "<td class='auto-shrink'>" . $rowsload["Reference"] . "</td>";
                        echo "<TD class = 'auto-shrink'>".$rowsload["Campus"]."</TD>";
                        echo "<td class='auto-shrink'>" . $rowsload["FromOffice"] . "</td>";
                        echo "<td class='auto-shrink'>" . $rowsload["Subject"] . "</td>";
                        echo "<td class='auto-shrink'>" . $rowsload["DocStatus"] . "</td>";
                        echo "<td class='auto-shrink text-center'><a href=' " . $rowsload["Upload"] . "'><i class='bi bi-eye btn btn-primary';'></i></a></td>";
                        echo "<td class='auto-shrink'>" . $rowsload["Received"] . " <br> ".$rowsload["Contact"]."</td>";
                        echo'</tr>';
                        echo'</tbody';
                            }
                    echo'</table>';
                    echo "<tr><td colspan='5'><button onclick='printArchivedDocuments()'>Print All Archived Documents</button></td></tr>";

                    echo'</div>
                    </div>
            
        </div>
</main>';

}
}
?>
<!--Main layout-->
<script>
        function printArchivedDocuments() {
        // Open a new window for printing
        var printWindow = window.open('', '_blank');

        // Append the table HTML to the new window
        printWindow.document.write('<html><head><title>Print Archived Documents</title></head><body>');
        printWindow.document.write(document.getElementById('searchstatus').innerHTML);
        printWindow.document.write('</body></html>');

        // Close the document
        printWindow.document.close();

        // Print the new window
        printWindow.print();
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" integrity="sha384-BNL3+R/wV+lY8dTlyryAO/b4mvjqKp1pSVsjv3IVyC1vQCZBM4B2L2eKJP5h/gjv" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>