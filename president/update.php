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

$sql = "SELECT * FROM doctrack.tbl_users WHERE Office = '$office'";
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
  
        <a href="pres" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold" aria-current="true">
          <i class="bi bi-card-list me-3"></i><span>Receive Document</span></a>
  
        <a href="update" id="active" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold"
        ><i class="bi bi-file-earmark-break me-3 text-white"></i><span>Update Status</span></a>
  
        <a href="release" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold">
          <i class="bi bi-check2-square me-3 text-white"></i><span>Complete Document</span></a>

          <a href="list" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold" aria-current="true">
          <i class="bi bi-card-list me-3"></i><span>List Document</span></a>
          
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
          $query = "SELECT * FROM tbl_inout WHERE Channel = 'PRESIDENT' AND DocStatus = 'RECEIVED' ORDER BY CDate DESC";
            $result = $conn->query($query);
            $numrows = $result->num_rows;
                    echo'<div class="table-container mt-2">
                    <table>
                        <thead>
                        <tr>';
                        echo "<TH class = 'query'>Tracking Number</TH>";
                        echo "<TH class = 'query'>Date</TH>";
                        echo "<TH class = 'query'>Campus</TH>";
                        echo "<TH class = 'query'>Office Origin</TH>";
                        echo "<TH class = 'query'>Subject</TH>";
                        echo "<TH class = 'query'>Document Status</TH>";
                        echo "<TH class = 'query'>Days Idle</TH>";
                        echo "<TH class = 'query'>Remarks</TH>";
                        echo "<TH class = 'query'>View</TH>";
                        echo "<TH class = 'query'>Download</TH>";
                        echo "<TH class = 'query'>Update</TH>";
                        echo'</tr>
                        </thead>
                        <tbody>';
                        while ($rows = $result->fetch_assoc()) 
{

                      $from = strtotime($rows["CDate"]);
                      $today = time();
                      $difference = floor(($today - $from) / 86400);

                      $currentDate = date("Y/m/d");
                        echo '<tr>';
                        echo "<TD class = 'query'>".$rows["Reference"]."</TD>";
                        echo "<TD class = 'query'>". $currentDate ." </TD>";
                        echo "<TD class = 'query'>".$rows["Campus"]."</TD>";
                        echo "<TD class = 'query'>".$rows["FromOffice"]."</TD>";
                        echo "<TD class = 'query'>".$rows["Subject"]."</TD>";
                        echo "<TD class = 'query'>".$rows["DocStatus"]."</TD>";
                        echo "<TD class = 'query'>".$difference."</TD>";
                        echo "<TD class = 'query'>".$rows["PresidentRemarks"]."</TD>";
                        echo "<td class='query'><a href=' " . $rows["Upload"] . "'>View</a></td>";
                        echo "<TD class='query'>";
                        echo "<DIV class='sub'>";
                        if ($rows["Upload"]) {
                            echo "<FORM action='download' method='post'>";
                            echo "<INPUT type='hidden' name='id' value='" . $rows['ID'] . "'>";
                            echo "<INPUT type='submit' name='download_file' value='Download'>";
                            echo "</FORM>";
                        }
                        echo "</TD>";
                        echo "<TD class='querycells'>";
                        echo '<div class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#update">';
                        echo "<INPUT type='button' class='update-button btn btn-danger btn-sm' data-reference='" . $rows['Reference'] . "' value='Update'>";
                              echo'</div>';
                        echo "</TD>";
                       echo' </tr>
                        </tbody
                    </table>
                    </div>
            
        </div>
</main>';


// echo "<div class='modal' id='updateModal'>
// <div class='modal-content'>
// <span class='close-button closeModal'>&times;</span>
//    <h2>Update Document Status</h2>
//    <FORM method='post' action='vpaa1modal'>";

// $sql = "SELECT * FROM doctrack.tbl_inout WHERE DocInOut = 'OUT' and Channel = 'PROCUREMENT'";
// $result = $conn->query($sql);
// if ($result && $result->num_rows > 0) {
// $row = $result->fetch_assoc();
// $reference = $row['Reference'];
// echo "<div class='reference'>
// 	   <input type='hidden' name='reference' value='$reference'>
// 	 </div>";
// }

// echo "
//    <div class='action'>
//    <label>Action Taken:</label>
//    <select name='action' id ='action' onchange = 'Action(this.value)' required>
// 	   <option value='' disabled selected>Action Taken</option>
// 	   <option value='APPROVED'>APPROVED</option>
// 	   <option value='PENDING'>PENDING</option>
// 	   <option value='DISAPPROVED'>DISAPPROVED</option>
//    </select>
//    </div>
//    <div class='remarks'>
//    <label for='remarks'>Remarks:</label>
//    <input type='text' name='remarks'>
//    </div>
//    <div class='doc'>
//    <label>DocStatus:</label>
//    <select name='doc' id ='doc' required>
// 	   <option value='' disabled selected>Status</option>
// 	   <option value='RELEASED'>RELEASED</option>
//    </select>
//    </div>
//    <div class='submit'>
//    <input type='submit' value='Submit' name='dateup'>
//    </div>
//    </form>
// </div>
// </div>";	


echo '<div class="modal fade" id="update" tabindex="-1">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Update Document Status</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">';
      echo"<FORM method='post' action='presmodal'>";

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
          <label for="recipient-name" class="col-form-label">Document Status :</label>';
          echo "
          <select name='doc' id ='doc' class='form-control' required>
          	   <option value='' disabled selected>Status</option>
          	   <option value='COMPLETED'>COMPLETED</option>
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
}
?>
<script>

function Action(selectedValue) {
    var docSelect = document.getElementById('doc');
    if (selectedValue === 'DISAPPROVED') {
        // If "DISAPPROVED" is selected, update the options in the "DocStatus" dropdown.
        docSelect.innerHTML = '<option value="DISAPPROVED">DISAPPROVED</option>';
    } else if (selectedValue === 'PENDING') {
        // If "PENDING" is selected, update the options in the "DocStatus" dropdown.
        docSelect.innerHTML = '<option value="PENDING">PENDING</option>';
    } else {
        // Reset the "DocStatus" dropdown to its default options.
        docSelect.innerHTML = '<option value="" disabled selected>Status</option>' +
                             '<option value="COMPLETED">COMPLETED</option>';
    }
}

</script>
<!--Main layout-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" integrity="sha384-BNL3+R/wV+lY8dTlyryAO/b4mvjqKp1pSVsjv3IVyC1vQCZBM4B2L2eKJP5h/gjv" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>