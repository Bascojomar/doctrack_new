<?php
include '../database.php';
include '../session.php';


$office = $_SESSION['Office'];

if ($office == 'RECORDS' ){
  header('location: ../records/dashboard');
}
elseif($office == 'VPAA'){
  header('location: ../vpaa/vpaa');
}
elseif($office == 'VPAA1'){
  header('location: ../vpaa/dashboard');
}
elseif($office == 'VPAA2'){
  header('location: ../vpaa/dashboard');
}
elseif($office == 'VPABM'){
  header('location: ../vpaa/vpaa');
}
elseif($office == 'VPABM1'){
  header('location: ../vpabm/dashboard');
}
elseif($office == 'VPABM2'){
  header('location: ../vpabm/dashboard');
}
elseif($office == 'VPRET'){
  header('location: ../vpaa/vpaa');
}
elseif($office == 'VPRET1'){
  header('location: ../vpret/dashboard');
}
elseif($office == 'VPRET2'){
  header('location: ../vpret/dashboard');
}
elseif($office == 'PRESIDENT'){
  header('location: ../vpaa/vpaa');
}
elseif($office == 'PRESIDENT1'){
  header('location: ../president/dashboard');
}
elseif($office == 'PRESIDENT2'){
  header('location: ../president/dashboard');
}
elseif($office == 'PROCUREMENT'){
  header('location: ../produrement/dashboard');
}

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
* {
  overflow: hidden;
}

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
.table-container::-webkit-scrollbar {
    display: none; /* Chrome, Safari, and Opera */
}
*{
      font-family: arial;
    }

.table-container {
        height: 78vh; /* Fixed height */
        overflow: auto;
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

    td {
      font-size: 0.9em;
    }

</style>

<header>
<?php

$sql = "SELECT * FROM doctrack.tbl_users WHERE Office = 'SITE ADMIN'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $imagePath = $row['Image'];
    $position = $row['Position'];
    $owner = $row['Owner'];
echo '
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-primary text-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-2 mt-3">
                    <a href="" id="active" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold" aria-current="true">
                        <i class="bi bi-person-add me-3"></i><span>Create Accounts</span></a>

                    <a href="request" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold">
                        <i class="bi bi-card-checklist me-3 text-white"></i><span>Password Request</span></a>

                    <a href="my_account" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold"
                        ><i class="bi bi-person me-3 text-white"></i><span>My Account</span></a>

                        <a href="../logout" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white"
                        ><i class="bi bi-box-arrow-right me-3 text-white"></i><span>Logout</span></a>

                </div>
            </div>
        </nav>
  
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
            <div class="title-sub fw-bold">ACCOUNTS</div>
            <div class="btn btn-primary pt-2" data-bs-toggle="modal" data-bs-target="#addAcc">
                Add Account
            </div>
            <div class="modal fade" id="addAcc" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Create Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">';
                  echo "<FORM action = 'create' method='POST' enctype='multipart/form-data'>";
                  echo '
                      <div class="mb-3 fw-bold">
                        <label for="recipient-name" class="col-form-label">Campus<span class="text-danger"> *</span></label>
                       <SELECT name = "campus" id="campus" required onchange="handleCampsSelection()" class="form-control">
                        <OPTION disabled selected hidden>Campus</OPTION>
                        <OPTION>General Tinio</OPTION>
                        <OPTION>San Isidro</OPTION>
                        <OPTION>Sumacab</OPTION>
                       <OPTION>Gabaldon</OPTION>
                        <OPTION>Atate</OPTION>
                        <OPTION>Fort Magsaysay</OPTION>
                        </SELECT>
                      </div>
                      <div class="mb-3 fw-bold">
                      <label for="recipient-name" class="col-form-label">Office<span class="text-danger"> *</span></label>
                      <SELECT name="office" class="form-control" id="office" onchange = "DisableOffice(this.value)" >
                      <OPTION value = """" disabled selected hidden>From Office</OPTION>
                      </SELECT>
                      </div>
                      <div class="mb-3 fw-bold">
                        <label for="recipient-name" class="col-form-label">Username<span class="text-danger"> *</span></label>
                        <INPUT type="text" name="username" class="form-control" placeholder="Username" oninput = "this.value = this.value.toUpperCase()" required>
                      </div>
                      <div class="mb-3 fw-bold">
                        <label for="recipient-name" class="col-form-label">Email<span class="text-danger"> *</span></label>
                        <INPUT type="email" name="email" placeholder="Ex. Juandelacruz@gmail.com" class="form-control" required>
                      </div>
                      <div class="mb-3 fw-bold">
                        <label for="recipient-name" class="col-form-label">Fullname<span class="text-danger"> *</span></label>
                        <INPUT type="text" class="form-control" name="owner" placeholder="Fullname" oninput = "this.value = this.value.toUpperCase()" required>
                      </div>  
                      <div class="mb-3 fw-bold">
                        <label for="recipient-name" class="col-form-label">File<span class="text-danger"> *</span></label>
                        <input type="file" class="form-control" name="file" required>
                      </div>
                      <div class="mb-3 fw-bold">
                        <label for="recipient-name" class="col-form-label">Password<span class="text-danger"> *</span></label>';
                        echo "<INPUT type='password' name='password' class='form-control' placeholder='Create Password' required></div>";
                        echo ' <div class="mb-3 fw-bold">
                        <label for="recipient-name" class="col-form-label">Position<span class="text-danger"> *</span></label>';
                        echo "<INPUT type='text' name='position' class='form-control' placeholder='Create position' oninput = 'this.value = this.value.toUpperCase()' required>";
                      echo '</div>';
                        echo ' <div class="mb-3 fw-bold">
                        <label for="recipient-name" class="col-form-label">Privilege<span class="text-danger"> *</span></label>';
                        echo "<INPUT type='text' class='form-control' name='privilege' placeholder='Privilege' oninput = 'this.value = this.value.toUpperCase()'>";
                      echo '</div>';
                      echo '
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
                        <div class="table-container mt-2">
                        <table>
                            <thead>
                            <tr>
                                <th>Owner</th>
                                <th>Position</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Email</th>
                                <th>Office</th>
                                <th>Campus</th>
                                <th class="text-center">Action</th>
                                <!-- <th class="text-center">Action</th> -->
                            </tr>
                            </thead>
                            ';
                            $query = "SELECT * FROM tbl_users";
                            $result = $conn->query($query);

                            if ($result->num_rows > 0) {
                                while ($rows = $result->fetch_assoc()) {
                                  echo "<tr class='' onclick='toggleRow(this)'>
                                  <td>" . $rows['Owner'] . "</td>
                                  <td>" . $rows['Position'] . "</td>
                                  <td>" . $rows['UserName'] . "</td>
                                  <td>" . $rows['Password'] . "</td>
                                  <td>" . $rows['Email'] . "</td>
                                  <td>" . $rows['Office'] . "</td>
                                  <td>" . $rows['Campus'] . "</td>";
                                  
                                echo '<td class="text-center">';

                                if ($rows["ID"]) {
                                  echo "<div class='btn-group'>";
                                    echo "<form action='send_pass' method='post'>";
                                    echo "<input type='hidden' name='id' value='" . $rows['ID'] . "'>";
                                    echo "<button type='submit' name='send_pass' value='Send' class='btn btn-primary btn-sm m-1'>";
                                    echo '<i class="bi bi-trash3"></i></button>';

                                    echo "</form>";

                                    echo "<form action='delete' method='post'>";
                                    echo "<input type='hidden' name='id' value='" . $rows['ID'] . "'>";
                                    echo "<button type='submit' name='delete_user' value='Delete' class='btn btn-danger btn-sm m-1'>";
                                    echo "<i class='bi bi-send'></i></button>";
                                  echo "</form>";
                                  echo "</div>";
                                  }
                                  echo ' </td>
                             
                            </tr>
                            </tbody
                            
                        </table>
                        </div>
                
            </div>
            ';
                                }}
}
            ?>

            
</main>
<!--Main layout-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" integrity="sha384-BNL3+R/wV+lY8dTlyryAO/b4mvjqKp1pSVsjv3IVyC1vQCZBM4B2L2eKJP5h/gjv" crossorigin="anonymous"></script>
<script>
    function toggleSidebar() {
    $(".sidebar").toggle();
    }

    function handleCampsSelection() {
    var campusSelect = document.getElementById("campus");
    var fromOfficeSelect = document.getElementById("office");
    var selectedCampus = campusSelect.value;

    // Reset the 'From Office' dropdown
    fromOfficeSelect.innerHTML = "<option value='' disabled selected hidden>From Office</option>";

    if (selectedCampus === "San Isidro") {
        fromOfficeSelect.innerHTML += "<option>COED</option>";
        fromOfficeSelect.innerHTML += "<option>CICT</option>";
        fromOfficeSelect.innerHTML += "<option>CMBT</option>";
    }
    if (selectedCampus === "General Tinio") {
        fromOfficeSelect.innerHTML += "<option>COAS</option>";
        fromOfficeSelect.innerHTML += "<option>COED</option>";
        fromOfficeSelect.innerHTML += "<option>CIT</option>";
        fromOfficeSelect.innerHTML += "<option>CON</option>";
        fromOfficeSelect.innerHTML += "<option>GS</option>";
    }
    if (selectedCampus === "Gabaldon") {
        fromOfficeSelect.innerHTML += "<option>COED</option>";
        fromOfficeSelect.innerHTML += "<option>CICT</option>";
        fromOfficeSelect.innerHTML += "<option>CMBT</option>";
        fromOfficeSelect.innerHTML += "<option>COA</option>";
    }
    if (selectedCampus === "Atate") {
        fromOfficeSelect.innerHTML += "<option>CICT</option>";
        fromOfficeSelect.innerHTML += "<option>CMBT</option>";
    }
    if (selectedCampus === "Fort Magsaysay") {
        fromOfficeSelect.innerHTML += "<option>CMBT</option>";
    }
    if (selectedCampus === "Sumacab") {
        fromOfficeSelect.innerHTML += "<option>COA</option>";
        fromOfficeSelect.innerHTML += "<option>COE</option>";
        fromOfficeSelect.innerHTML += "<option>COED</option>";
        fromOfficeSelect.innerHTML += "<option>COC</option>";
        fromOfficeSelect.innerHTML += "<option>CICT</option>";
        fromOfficeSelect.innerHTML += "<option>CMBT</option>";
        fromOfficeSelect.innerHTML += "<option>COPADM</option>";
        fromOfficeSelect.innerHTML += "<option>COARCH</option>";
    }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<style>
  a {
    color: black !important;
    text-decoration: none !important;
  }
</style>
</body>
</html>
