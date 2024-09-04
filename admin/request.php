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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/dataTables.bootstrap5.min.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <style>
        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        .navbar {
            background: gray !important;
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
            main {
                margin-top: 10vh;
            }
        }

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        #sidebarMenu {
            background-color: white !important;
        }

        #sidebarMenu a {
            background-color: black !important;
            margin-bottom: .5vh;
            border-bottom: none;
        }

        #sidebarMenu a:hover {
            background: linear-gradient(to right, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0));
            border-radius: 3px 3px 3px 3px;
        }

        .mx-4 {
            margin-top: 12.5vh;
        }

        #active {
            background: linear-gradient(to right, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0));
            border-radius: 3px 3px 3px 3px;
        }

        #sidebarMenu i {
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

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
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
        }

        .title-sub {
            font-size: 30px;
        }

        .table-container::-webkit-scrollbar {
            display: none; /* Chrome, Safari, and Opera */
        }

        * {
            font-family: arial;
        }

        * {
            overflow: hidden;
        }

        td{
            height:3.7vh;
        }
    </style>
</head>
<body>
    <!--Main Navigation-->
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

                                
                                <a href="audit" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold">
                                <i class="bi bi-card-checklist me-3 text-white"></i><span>Audit</span></a>
                                
                                    <a href="my_account" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white fw-semibold">
                                    <i class="bi bi-person me-3 text-white"></i><span>My Account</span></a>

                                <a href="../logout" class="list-group-item list-group-item-action py-2 ripple bg-primary text-white">
                                    <i class="bi bi-box-arrow-right me-3 text-white"></i><span>Logout</span></a>
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
                                onclick="toggleSidebar()">
                                <i class="fas fa-bars"></i>
                            </button>

                            <!-- Brand -->
                            <a class="navbar-brand my-auto d-flex flex-row" href="#"></a>

                            <!-- Right links -->
                            <ul class="navbar-nav ms-auto d-flex flex-row align-items-center">
                                <!-- Avatar -->
                                <div class="d-flex align-items-center">
                                    <img
                                        src="' . $imagePath . '"
                                        class="rounded-circle"
                                        style="height: 9vh;width: 9vh;"
                                    />
                                    <div class="d-flex flex-column mx-2">
                                        <p class="text-white fw-semibold mb-0">
                                            ' . $owner . '
                                        </p>
                                        <span class="text-white" style="font-size: smaller; margin-top: -5px;">' . $position . '</span>
                                    </div>
                                </div>
                            </ul>
                        </div>
                        <!-- Container wrapper -->
                    </nav>
                    <!-- Navbar -->';
                echo '<main>';
                echo '<div class="mx-4 px-2 pb-2">
                    <div class="title">
                        <div class="title-sub fw-bold">PASSWORD REQUEST</div>
                    </div>
                    <div class="table-container mt-2 pt-3 px-3">
                    <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Campus</th>
                                    <th>Email</th>
                                    <th>Employee ID</th>
                                    <th>Letter</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>';
                                $query = "SELECT * FROM tbl_users";
                                $result = $conn->query($query);
                                while ($rows = $result->fetch_assoc()) {
                                    // Check if the "Letter" column has a value
                                    if (!empty($rows["Letter"])) {
                                        echo "<tr>";
                                        echo "<td>" . $rows["Campus"] . "</td>";
                                        echo "<td>" . $rows["Email"] . "</td>";
                                        echo "<td>" . $rows["UserName"] . "</td>";
                                        echo "<td>" . $rows["Request"] . $rows["Letter"] . "</td>";
                                        echo "<td><form action='' method='POST' class='text-center'><input type='hidden' name='users' value='" . $rows["UserName"] . "'><input type='hidden' name='pass' value='" . $rows["Password"] . "'><input type='hidden' name='camp' value='" . $rows["Campus"] . "'><input type='hidden' name='email' value='" . $rows["Email"] . "'><input type='hidden' name='id' value='" . $rows["ID"] . "'><button type='submit' class='btn btn-primary' name='approved' value='Approved'><i class='bi bi-hand-thumbs-up' style='font-size:22px;'></i> Approved</button></form></td>";
                                        echo "</tr>";
                                    }
                                }
                            echo '</tbody>
                        </table>
                    </div>
                </div>';
            }

            // sending aprroved

            
// send password and username
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// Assuming you have a database connection established in $conn

if (isset($_POST['approved'])) {
  $user_id_to_delete = $_POST['id'];

  // Display a confirmation dialog using SweetAlert
  echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
              var sweetAlertScript = document.createElement('script');
              sweetAlertScript.src = 'https://unpkg.com/sweetalert/dist/sweetalert.min.js';
              document.head.appendChild(sweetAlertScript);
              
              sweetAlertScript.onload = function() {
                  swal({
                      title: 'Are you sure?',
                      text:'You want to send this username and password?',
                      icon: 'warning',
                      buttons: true,
                      dangerMode: true,
                  })
                  .then((willDelete) => {
                      if (willDelete) {
                          window.location.href = 'request?id=$user_id_to_delete&confirmed=1';
                      } else {
                          window.location.href = 'request';
                      }
                  });
              };
          });
        </script>";

}


// Check for confirmation parameter and perform the deletion
if (isset($_GET['confirmed']) && $_GET['confirmed'] == 1) {
    $user_id_to_delete = $_GET['id'];
    
        $sql = "SELECT * FROM tbl_users WHERE ID = '$user_id_to_delete'";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = $row['UserName'];
            $pass = $row['Password'];
            $uniqueId = $row['ID'];
            $email = $row['Email'];
            
            $subject = "Document Status Update in campus";
            $message = "Greetings campus<br>
            Your document Username : $user <br> Password : $pass.";
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'docutracking01@gmail.com';
            $mail->Password = 'jiejyzzhrhpjltug';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            
            $mail->setFrom('docutracking01@gmail.com');
            $mail->addAddress($email);
            $mail->isHTML(true);
            
            $mail->Subject = $subject;
            $mail->Body = $message;
            
                $mail->send();
            
            
            $updateQuery = "UPDATE tbl_users SET Letter = '', Request = '' WHERE ID = $uniqueId";
            $conn->query($updateQuery);
           
    
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
              var sweetAlertScript = document.createElement("script");
              sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
              document.head.appendChild(sweetAlertScript);
            
              sweetAlertScript.onload = function() {
                swal({
                  title: "Successful Sending Password",
                  text: "Send",
                  icon: "success",
                  buttons: false,
                  timer: 1200
                }).then(function() {
                  window.location.href = "request";
                });
              };
            });
            </script>';
            
            
    }
    }
        ?>
    </main>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#example');
    </script>
</body>
</html>
