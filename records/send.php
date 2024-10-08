<?php
include '../database.php';
include '../session.php';


$sql = "SELECT * FROM doctrack.tbl_users WHERE Office = 'RECORDS'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  $office = $row['Office'];

  $_SESSION['allowedoffice'] = $office;
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

* {
  overflow: hidden;
}

#active{
    background: linear-gradient(to right, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0));
    border-radius: 3px 3px 3px 3px;
}

#sidebarMenu i{
    font-size: 20px;
}

.table-container::-webkit-scrollbar {
    display: none; /* Chrome, Safari, and Opera */
}

.table-container {
        height: 78vh; /* Fixed height */
        overflow-y: auto;
        border: 1px solid #ccc; /* Add border */
        border-radius: 4px; /* Add border radius */
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

    .form-check-input {
      width: 5vh;
      height: 5vh;
      margin-right: 2vh;
      border: solid 1px gray;
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

          <a href="" id="active" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold">
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
            <div class="title-sub fw-bold">NEW DOCUMENT</div>

        </div>';
        $isDisabled = true; 
        $date = date('Yms');
        $randomNumber = mt_rand(1, 99999); // Generates a random number between 1 and 999
        $result = $date . $randomNumber;
        $date1 = date('y-m-d');
        echo '
        <div class="table-container mt-2">
            <div class="row my-2 mx-2">
                <div class="col- 2 fw-bold col-form-label">Tracking Number</div>
                <div class="col- 10"> </div>
                <div class="col-12 mb-2">';
                echo "<FORM action = 'new' method = 'POST' enctype = 'multipart/form-data' autocomplete = 'off'>";
                echo "<input type='text' id='reference' name='reference' class='form-control' value='NEUST$result'";
                if ($isDisabled) {
                  echo " readonly";
                }
                echo " oninput='this.value = this.value.toUpperCase()'>";
                echo '
                </div>

                <div class="col- 2 fw-bold col-form-label">Calendar Date</div>
                <div class="col- 10"> </div>
                <div class="col-12 mb-2">';
                echo "<input type='text' id='cdate' name='cdate' class='form-control' value='  $date1'";
                if ($isDisabled) {
                  echo " readonly";
                }
                echo " oninput='this.value = this.value.toUpperCase()'>";
                echo '</div>

                <div class="col- 2 fw-bold col-form-label">Files</div>
                <div class="col- 10"> </div>
                <div class="col-12 mb-2">';
                echo "<INPUT type = 'file' name='uploadfile' class = 'form-control' accept='application/pdf'>";
                echo'</div>

                <div class="col- 2 fw-bold col-form-label">Campus</div>
                <div class="col- 10"> </div>
                <div class="col-12 mb-2">';
                echo '<select name="campus" id="campus" class="form-control" required onchange="loadOffices(this.value)">';
                
                $query = "SELECT * FROM tbl_campus ORDER BY campus_id";
                $results = $conn->query($query);
                $numrows = $result->num_rows;
              
                while ($rows = $results->fetch_assoc()) 
                {
                  echo "<OPTION id = 'camp' disabled selected hidden>Campus</OPTION>";
                  echo "<OPTION id = 'camp' value = '".$rows["campus_id"]."'>".$rows["campus_name"]."</OPTION>";
                }

                echo'</select>';
                echo'</div>

                <div class="col- 2 fw-bold col-form-label">From Office</div>
                <div class="col- 10"> </div>
                <div class="col-12 mb-2">';
                echo '<select name="fromoffice" id="fromoffice" class="form-control" required>';
                echo "<option value='' disabled selected hidden>Select Office</option>";
                echo "</SELECT>";
                echo'</div>

                <div class="col- 2 fw-bold col-form-label">Other Office</div>
                <div class="col- 10"> </div>
                <div class="col-12 mb-2">';
                echo "<INPUT type = 'text' value='-' name = 'othersoffice' id = 'otheroffice' class = 'form-control' oninput = 'this.value = this.value.toUpperCase()' placeholder = '  From Other Office'>";
                echo '</div>

                <div class="col- 2 fw-bold col-form-label">Email</div>
                <div class="col- 10"> </div>
                <div class="col-12 mb-2">';
                echo "<input type='email' id='gmail' name='gmail' class='form-control' placeholder='  Ex. Juandelacruz@gmail.com' required>";
                echo'</div>

                <div class="col- 2 fw-bold col-form-label">Requesting Personel</div>
                <div class="col- 10"> </div>
                <div class="col-4 mb-2">';
                echo "<INPUT type = 'text' name = 'fromperson' class = 'form-control' placeholder = '  Lastname' oninput = 'this.value = this.value.toUpperCase()' required>";
                echo'</div>
                <div class="col-4 mb-2">';
                echo "<INPUT type = 'text' name = 'fromperson' class = 'form-control' placeholder = '  Firstname' oninput = 'this.value = this.value.toUpperCase()' required>";
                echo '</div>
                <div class="col-4 mb-2">';
                echo "<INPUT type = 'text' name = 'fromperson' class = 'form-control' placeholder = '  Middle Initial' oninput = 'this.value = this.value.toUpperCase()' required>";
                echo'</div>

                <div class="col- 2 fw-bold col-form-label">Subject</div>
                <div class="col- 10"> </div>
                <div class="col-12 mb-2">';
                echo "<INPUT type = 'text' name = 'subject' class = 'form-control' placeholder = '  Subject' oninput = 'this.value = this.value.toUpperCase()'>";
                echo'</div>

                <div class="col- 2 fw-bold col-form-label">Document Type</div>
                <div class="col- 10"> </div>
                <div class="col-12 mb-2">';
                echo "<SELECT name='docutype' class='form-control' onchange='toggleVoucherType(this.value); DisableVoucherType(this.value);' required>";
                echo "<OPTION value = '' disabled selected hidden>Document Type</OPTION>";
              
                $query = "SELECT * FROM tbl_docutype ORDER BY DocuType";
                $result = $conn->query($query);
                $numrows = $result->num_rows;
              
                while ($rows = $result->fetch_assoc()) 
                {
                  echo "<OPTION id = 'com' value = '".$rows["DocuType"]."'>".$rows["DocuType"]."</OPTION>";
                }
                echo "</SELECT>";
                echo'</div>

                <div id="voucherSection" style="display: none;">
    <div class="col-2 fw-bold col-form-label">VoucherType</div>
    <div class="col-10">';
        echo "<SELECT name='vouchertype' id='vouchertype' class='form-control'>";
        echo "<OPTION value='' disabled selected hidden>Voucher Type</OPTION>";

        $query = "SELECT * FROM tbl_vouchertype ORDER BY VoucherType";
        $result = $conn->query($query);

        while ($rows = $result->fetch_assoc()) {
            echo "<OPTION value='".$rows["VoucherType"]."'>".$rows["VoucherType"]."</OPTION>";
        }

        echo '</SELECT>

    </div>
    <div class="col-2 fw-bold col-form-label">Voucher No.</div>
    <div class="col-10">
        <input type="text" name="voucherno" class="form-control" id="voucherno" oninput="this.value = this.value.toUpperCase()" placeholder="  Voucher No.">
    </div>
    <div class="col-2 fw-bold col-form-label">Voucher Amount</div>
    <div class="col-10">
        <input type="text" name="voucheramt" class="form-control" id="voucheramt" placeholder="  Voucher Amount" oninput="this.value = this.value.toUpperCase()">
    </div>
</div>
                <div class="col-12 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title fw-bold form-label">
                                Channels (Please CHECK):
                            </div>
                            <div class="form-group">
                              <div class="form-check">';
                              echo "<INPUT type = 'checkbox' class='form-check-input' name = 'pr' value = 'yes'>";
                                echo '<label class="form-check-label" for="procurementCheckbox">
                                  Procurement
                                </label>
                              </div>
                              <div class="form-check">';
                              echo "<INPUT type = 'checkbox' class='form-check-input' name = 'vpaa' value = 'yes'>";
                                echo '<label class="form-check-label" for="vpaaCheckbox">
                                  VPAA
                                </label>
                              </div>
                              <div class="form-check">';
                              echo "<INPUT type = 'checkbox' class='form-check-input' name = 'vpabm' value = 'yes'>";
                                echo '<label class="form-check-label" for="vpabmCheckbox">
                                  VPABM
                                </label>
                              </div>
                              <div class="form-check">';
                              echo "<INPUT type = 'checkbox' class='form-check-input' name = 'vpret' value = 'yes'>";
                              echo'  <label class="form-check-label" for="vpretCheckbox">
                                  VPRET
                                </label>
                              </div>
                              <div class="form-check">';
                              echo "<INPUT type = 'checkbox' class='form-check-input' name = 'president' value = 'yes'>";
                              echo' <label class="form-check-label" for="presidentCheckbox">
                                  President
                                </label>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="text-center">
                <div class="btn btn-primary px-5">';
                echo "<INPUT type = 'submit' value = 'SAVE' class='btn btn-primary px-5' />";
                echo'</div>
                <div class="btn btn-danger px-5">';
                echo "<INPUT type = 'reset' value = 'CANCEL' class='btn btn-danger px-5' />";
                echo '</div>
            </div>
        </div>
        </div>';
        echo "</FORM>";
}
        ?>
</main>
<script>
function loadOffices(campusId) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'send_select_campus.php?campus_name=' + campusId, true);
    xhr.onload = function () {
        if (this.status == 200) {
            document.getElementById('fromoffice').innerHTML = this.responseText;
        }
    };
    xhr.send();
}
</script>
<script>
function toggleVoucherType(selectedValue) {
    const voucherSection = document.getElementById('voucherSection');
    if (selectedValue === 'COMMUNICATIONS') {
        voucherSection.style.display = 'none';
    }
    else if (selectedValue === '-') {
        voucherSection.style.display = 'none';
    } else {
        voucherSection.style.display = 'block';
    }
}
</script>
<!--Main layout-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" integrity="sha384-BNL3+R/wV+lY8dTlyryAO/b4mvjqKp1pSVsjv3IVyC1vQCZBM4B2L2eKJP5h/gjv" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
  
	function DisableOffice(elementName) {

if (elementName != 'OTHERS'){
  document.getElementById("otheroffice").readOnly = true;
  document.getElementById("otheroffice").value = "-";
}
else {
        // If elementName is 'OTHERS', set the readOnly property to false
        document.getElementById("otheroffice").readOnly = false;
        // You can also set the value to an empty string or any default value if needed
        document.getElementById("otheroffice").value = "";
    }

}

function DisableVoucherType(elementName) {

if (elementName === 'COMMUNICATIONS'){
  document.getElementById("vouchertype").readOnly = true;
  document.getElementById("vouchertype").value = "-";
  document.getElementById("voucherno").readOnly = true;
  document.getElementById("voucherno").value = "-";
  document.getElementById("voucheramt").readOnly = true;
  document.getElementById("voucheramt").value = "-";
}
if (elementName === 'VOUCHERS/P.O'){
  document.getElementById("vouchertype").readOnly = false;
  document.getElementById("vouchertype").value = "";
  document.getElementById("voucherno").readOnly = false;
  document.getElementById("voucherno").value = "";
  document.getElementById("voucheramt").readOnly = false;
  document.getElementById("voucheramt").value = "";
}
else{

}

}
</script>
</body>
</html>