
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<TITLE>Document Tracking - Nueva Ecija University of Science and Technology</TITLE>

</HEAD>
<style>
        body {
    background: url(log.png) no-repeat fixed top/cover;
}

.login_logo{
    height: 280px;
}

.login-container {
width: 420px;
height: 320px;
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
border-radius: 10px 10px 10px 10px;
background: rgba(255, 255, 255, 0.80);
margin: 0 auto;
position: relative;
z-index: 1;
padding-bottom: 100px;
}


.input-container {
width: 110%;
display: flex;
flex-direction: row;
align-items: center;
margin: 15px 0;
}

.input-field {
width: 100%;
padding: 11px;
font-size: 16px;
border: none;
outline: none;
background: rgba(255, 255, 255, 0.53);
box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25) inset;
border-radius: 0px 5px 5px 0px;
}

.icon {
padding: 10px;
background-color:#0E2A7D;
color: white;
min-width: 35px;
min-height: 20px;
text-align: center;
border-radius: 5px 0px 0px 5px;
margin-left: -28px;
}

.btn {
width: 60%;
padding: 10px;
font-size: 18px;
border-radius: 5px;
background: #F89318;
color: white;
border: none;
cursor: pointer;
margin-top: 20px;
font-weight: bold;
}

.btn:hover{
width: 60%;
padding: 10px;
font-size: 18px;
border-radius: 5px;
background: #0E2A7D;
color: white;
border: none;
cursor: pointer;
margin-top: 20px;
font-weight: bold;
}

.center{
text-align: center;
}

h1 {
font-size: 36px;
margin-bottom: 40px;
text-align: center;
}

p {
font-size: 16px;
color: #F89318;
text-align: center;
margin-top: 20px;
}

a {
color: #0E2A7D;
text-decoration: none;
}

.all{
margin-top: 10%;
}

@media only screen and (max-width: 600px) {
    .all{
        margin-top: 25%;
        }
}
    </style>
	<BODY class="bg" onLoad = 'document.loginform.username.focus()'>
	<?php 
		include 'database.php'; 
		session_start();
		include "usersession.php";
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$username = mysqli_real_escape_string($conn,$_POST['username']);
			$password = mysqli_real_escape_string($conn,$_POST['password']);
		
			$sql = "SELECT * FROM doctrack.tbl_users WHERE UserName='$username' AND Password='$password'";
			$result = $conn->query($sql);
		
			if ($result->num_rows == 1) {
				$row = $result->fetch_assoc();
				$_SESSION['ID'] = $row['ID'];
				$_SESSION['Office'] = trim($row['Office']);  // Trim any leading or trailing spaces

				$queryallowed = "SELECT AllowedOffice FROM tbl_allowed WHERE Menu = 'NEW'";
				$resultallowed = $conn->query($queryallowed);
				$numrowsallowed = $resultallowed->num_rows;
				unset($array_data);
				$array_data = array();
			  
				while ($rowsallowed = $resultallowed->fetch_assoc())
				{
				  $array_data[] = $rowsallowed['AllowedOffice'];
				}
			
				if ($_SESSION['Office'] === 'RECORDS') {
					echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
					echo "<script>Swal.fire({
						title: 'Login Successful!',
						text: 'Redirecting to records dashboard...',
						icon: 'success',
						timer: 2000,
						timerProgressBar: true,
						showConfirmButton: false
					}).then(function() { window.location = 'records/dashboard'; });</script>";
					$query = "INSERT INTO tbl_login (user_id, activity, time_stamp) VALUES ('1', '$username', NOW())";
					$result = mysqli_query($conn, $query);
	
				}
				elseif ($_SESSION['Office'] === 'SITE ADMIN') {
					echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
					echo "<script>Swal.fire({
						title: 'Login Successful!',
						text: 'Redirecting to admin dashboard...',
						icon: 'success',
						timer: 2000,
						timerProgressBar: true,
						showConfirmButton: false
					}).then(function() { window.location = 'admin/admin'; });</script>";
					$query = "INSERT INTO tbl_login (user_id, activity, time_stamp) VALUES ('1', '$username', NOW())";
					$result = mysqli_query($conn, $query);
	
				}
				elseif ($_SESSION['Office'] === 'PRESIDENT') {
					echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
					echo "<script>Swal.fire({
						title: 'Login Successful!',
						text: 'Redirecting to president dashboard...',
						icon: 'success',
						timer: 2000,
						timerProgressBar: true,
						showConfirmButton: false
					}).then(function() { window.location = 'vpaa/vpaa'; });</script>";
					$query = "INSERT INTO tbl_login (user_id, activity, time_stamp) VALUES ('1', '$username', NOW())";
					$result = mysqli_query($conn, $query);
	
				}
				elseif ($_SESSION['Office'] === 'PRESIDENT1') {
					echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
					echo "<script>Swal.fire({
						title: 'Login Successful!',
						text: 'Redirecting to presidentstaff dashboard...',
						icon: 'success',
						timer: 2000,
						timerProgressBar: true,
						showConfirmButton: false
					}).then(function() { window.location = 'president/dashboard'; });</script>";
					$query = "INSERT INTO tbl_login (user_id, activity, time_stamp) VALUES ('1', '$username', NOW())";
					$result = mysqli_query($conn, $query);
	
				}
				elseif ($_SESSION['Office'] === 'PRESIDENT2') {
					echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
    echo "<script>Swal.fire({
        title: 'Login Successful!',
        text: 'Redirecting to presidentstaff dashboard...',
        icon: 'success',
        timer: 2000,
        timerProgressBar: true,
        showConfirmButton: false
    }).then(function() { window.location = 'president/dashboard'; });</script>";
	$query = "INSERT INTO tbl_login (user_id, activity, time_stamp) VALUES ('1', '$username', NOW())";
	$result = mysqli_query($conn, $query);

				}
				elseif ($_SESSION['Office'] === 'VPAA') {
					echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
					echo "<script>Swal.fire({
						title: 'Login Successful!',
						text: 'Redirecting to vpaa dashboard...',
						icon: 'success',
						timer: 2000,
						timerProgressBar: true,
						showConfirmButton: false
					}).then(function() { window.location = 'vpaa/vpaa'; });</script>";
					$query = "INSERT INTO tbl_login (user_id, activity, time_stamp) VALUES ('1', '$username', NOW())";
					$result = mysqli_query($conn, $query);
	
				} 
				elseif ($_SESSION['Office'] === 'VPABM') {
					echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
					echo "<script>Swal.fire({
						title: 'Login Successful!',
						text: 'Redirecting to vpabm dashboard...',
						icon: 'success',
						timer: 2000,
						timerProgressBar: true,
						showConfirmButton: false
					}).then(function() { window.location = 'vpaa/vpaa'; });</script>";
					$query = "INSERT INTO tbl_login (user_id, activity, time_stamp) VALUES ('1', '$username', NOW())";
					$result = mysqli_query($conn, $query);
	
				}
				elseif ($_SESSION['Office'] === 'VPRET') {
					echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
					echo "<script>Swal.fire({
						title: 'Login Successful!',
						text: 'Redirecting to vpret dashboard...',
						icon: 'success',
						timer: 2000,
						timerProgressBar: true,
						showConfirmButton: false
					}).then(function() { window.location = 'vpaa/vpaa'; });</script>";
					$query = "INSERT INTO tbl_login (user_id, activity, time_stamp) VALUES ('1', '$username', NOW())";
					$result = mysqli_query($conn, $query);
	
				} 
				elseif ($_SESSION['Office'] === 'VPAA1') {
					echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
					echo "<script>Swal.fire({
						title: 'Login Successful!',
						text: 'Redirecting to vpaastaff dashboard...',
						icon: 'success',
						timer: 2000,
						timerProgressBar: true,
						showConfirmButton: false
					}).then(function() { window.location = 'vpaa/dashboard'; });</script>";
					$query = "INSERT INTO tbl_login (user_id, activity, time_stamp) VALUES ('1', '$username', NOW())";
					$result = mysqli_query($conn, $query);
	
				} 
				elseif ($_SESSION['Office'] === 'VPAA2') {
					echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
					echo "<script>Swal.fire({
						title: 'Login Successful!',
						text: 'Redirecting to vpaastaff dashboard...',
						icon: 'success',
						timer: 2000,
						timerProgressBar: true,
						showConfirmButton: false
					}).then(function() { window.location = 'vpaa/dashboard'; });</script>";
					$query = "INSERT INTO tbl_login (user_id, activity, time_stamp) VALUES ('1', '$username', NOW())";
					$result = mysqli_query($conn, $query);
	
				} 
				elseif ($_SESSION['Office'] === 'VPABM1') {
					echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
					echo "<script>Swal.fire({
						title: 'Login Successful!',
						text: 'Redirecting to vpabmstaff dashboard...',
						icon: 'success',
						timer: 2000,
						timerProgressBar: true,
						showConfirmButton: false
					}).then(function() { window.location = 'vpabm/dashboard'; });</script>";
					$query = "INSERT INTO tbl_login (user_id, activity, time_stamp) VALUES ('1', '$username', NOW())";
					$result = mysqli_query($conn, $query);
	
				}
				elseif ($_SESSION['Office'] === 'VPABM2') {
					echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
					echo "<script>Swal.fire({
						title: 'Login Successful!',
						text: 'Redirecting to vpabmstaff dashboard...',
						icon: 'success',
						timer: 2000,
						timerProgressBar: true,
						showConfirmButton: false
					}).then(function() { window.location = 'vpabm/dashboard'; });</script>";
					$query = "INSERT INTO tbl_login (user_id, activity, time_stamp) VALUES ('1', '$username', NOW())";
					$result = mysqli_query($conn, $query);
	
				}
				elseif ($_SESSION['Office'] === 'VPRET1') {
					echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
					echo "<script>Swal.fire({
						title: 'Login Successful!',
						text: 'Redirecting to vpretstaff dashboard...',
						icon: 'success',
						timer: 2000,
						timerProgressBar: true,
						showConfirmButton: false
					}).then(function() { window.location = 'vpret/dashboard'; });</script>";
					$query = "INSERT INTO tbl_login (user_id, activity, time_stamp) VALUES ('1', '$username', NOW())";
					$result = mysqli_query($conn, $query);
	
				} 
				elseif ($_SESSION['Office'] === 'VPRET2') {
					echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
					echo "<script>Swal.fire({
						title: 'Login Successful!',
						text: 'Redirecting to vpretstaff dashboard...',
						icon: 'success',
						timer: 2000,
						timerProgressBar: true,
						showConfirmButton: false
					}).then(function() { window.location = 'vpret/dashboard'; });</script>";
					$query = "INSERT INTO tbl_login (user_id, activity, time_stamp) VALUES ('1', '$username', NOW())";
					$result = mysqli_query($conn, $query);
	
				} 
				elseif ($_SESSION['Office'] === 'PROCUREMENT') {
					echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
					echo "<script>Swal.fire({
						title: 'Login Successful!',
						text: 'Redirecting to procurement dashboard...',
						icon: 'success',
						timer: 2000,
						timerProgressBar: true,
						showConfirmButton: false
					}).then(function() { window.location = 'procurement/dashboard'; });</script>";
					$query = "INSERT INTO tbl_login (user_id, activity, time_stamp) VALUES ('1', '$username', NOW())";
					$result = mysqli_query($conn, $query);
	
				} else {
					echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
					echo "<script>Swal.fire({
						title: 'Login Successful!',
						text: 'Redirecting to dashboard...',
						icon: 'success',
						timer: 2000,
						timerProgressBar: true,
						showConfirmButton: false
					}).then(function() { window.location = 'others/track'; });</script>";
					$query = "INSERT INTO tbl_login (user_id, activity, time_stamp) VALUES ('1', '$username', NOW())";
					$result = mysqli_query($conn, $query);
	
					exit();
				}
			} else {

				echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>';
				echo "<script>Swal.fire({
					title: 'Login Successful!',
					text: 'Username or Password...',
					icon: 'warning',
					timer: 2000,
					timerProgressBar: true,
					showConfirmButton: false
				}).then(function() { window.location = 'index1'; });</script>";
			}
		}

		else
		
	?>
<!-- <main>
	<div class = "containerindex">
	<div class="side">
		<div id="loginmain">
			<div id = "loginform" class="nav">
			<div class="img">
                <img src="./pic/logg.png">
				</div>
				<div id = "loginlogo" class="bar">
					<IMG src = "./pic/logoo.png">
				</div>
				<div class="log">
				<form action = "" method = "post" enctype = "multipart/form-data" id = "login" name = "loginform" autocomplete = 'off'>
				<label>Username :</label>	
				<input type = "text" class = 'forminput' placeholder="Username" name="username" pattern = "[a-zA-Z0-9]+" onclick = "this.setSelectionRange(0,this.value.length)" style = "height: 20px; margin-bottom: 20px; text-align: center; font-style: italic" id = 'username' required>
				<label>Password :</label>
				<input type = "password" id = "namepassword" class = 'forminput' placeholder="Password" name="password" onclick = "this.setSelectionRange(0,this.value.length)" style = "height: 20px; margin-bottom: 20px; text-align: center; font-style: italic" required>
				
				<div class="submit">
            		<input type="submit" name="login" value="LOGIN">
            	</div>

				<div class="forget"><i><a href="forget.php">Forget Password</a></i></div>

				</div>
				</div>
			</div>
		</div>
	</div>
</main>
</BODY>
</HTML> -->

<div class="all">
    <div class="login-container">
        <div >
            <a href="index"><img class="login_logo" src="NEUSTlogo.png" alt=""></a>
        </div>
		<form action = "" method = "post" enctype = "multipart/form-data" id = "login" name = "loginform" autocomplete = 'off'>
        <div class="input-container">
          <i class="fa fa-envelope icon"></i>
		  <input type = "text" class="input-field" placeholder="Username" name="username" onclick = "this.setSelectionRange(0,this.value.length)" required>
          <!-- <input class="input-field" type="text" placeholder="Enter your username" id="your_username" name="username" autocomplete="off" required>text="email" for requiring @ -->
        </div>
        <div class="input-container">
          <i class="fa fa-key icon"></i>
		  <input  type = "password" id = "namepassword" class="input-field" placeholder="Password" name="password" onclick = "this.setSelectionRange(0,this.value.length)"  required>
          <!-- <input class="input-field" type="password" placeholder="Enter your password" id="your_password" name="password" autocomplete="off" required>required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" -->
        </div>
        <div class="center">
            <input type="submit" id="loginButton" class="btn" value="LOGIN" name="Login">
        </div>
        <div class="center">
            <a href="forget"><p style="color: #14369C;">Forgot your password?</p></a>
        </div>
        <br>
      </form>
    </div>
    </div>
</body>
</html>