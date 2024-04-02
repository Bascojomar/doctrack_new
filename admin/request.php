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
*{
      font-family: arial;
    }
    * {
  overflow: hidden;
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
                    <a href="admin"  class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold" aria-current="true">
                        <i class="bi bi-person-add me-3"></i><span>Create Accounts</span></a>

                    <a href="" id="active" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold">
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
    ';
    echo '<div class="mx-4 px-2 pb-2">
        <div class="title">
            <div class="title-sub fw-bold">PASSWORD REQUEST</div>
          </div>
          <div class="table-container mt-2">';
          
    $query = "SELECT * FROM tbl_users";
		$result = $conn->query($query);
		
		while ($rows = $result->fetch_assoc()) {
			// Check if the "Letter" column has a value
			if (!empty($rows["Letter"])) {
				echo "<form action='sendreq' method='POST'>";
				$pass = $rows['Password'];
				$user = $rows['UserName'];
				$email = $rows['Email'];
				$uniqueId = $rows['ID'];
				$campus = $rows['Campus'];

        echo "<div class='reference'>
					   <input type='hidden' name='users' value='$user'>
					   <input type='hidden' name='pass' value='$pass'>
					   <input type='hidden' name='camp' value='$campus'>
					   <input type='hidden' name='email' value='$email'>
					   <input type='hidden' name='unique_id' value='$uniqueId'>
					 </div>";
          echo '
                    <div mt-2">
                    
                            <div class="mx-2 my-2">
                                <div class="card text-start">
                                    <div class="card-body">
                                      <div class="row">
                                        <div class="col-2">
                                          <p class="card-text fw-semibold">Campus :</p>
                                          <p class="card-text fw-semibold">Email :</p>
                                          <p class="card-text fw-semibold">Employee ID :</p>
                                          <p class="card-text fw-semibold">Letter :</p>
                                        </div>
                                        <div class="col-8">
                                          <p class="card-text fw-semibold">'. $rows["Campus"] .'</p>
                                          <p class="card-text fw-semibold">'. $rows["Email"] .'</p>
                                          <p class="card-text fw-semibold">'. $rows["UserName"] .'</p>
                                          <p class="card-text fw-semibold">'. $rows["Request"] . $rows["Letter"] .'</p>
                                        </div>
                                        <div class="col-2">
                                          <input type="submit" class="btn btn-primary mt-5" name="approved" value="Approved">
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            </div>';
                            echo "</form>";
                          }
        }
}
        ?>
</main>
</body>
</html>
