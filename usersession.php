<?php 
	session_start();
if ( isset($_SESSION['Office']) ) {
    // User is already logged in, redirect to another page
	if ($_SESSION['Office'] == 'RECORDS') {
		header("location:records/dashboard");
		exit();
	}
	elseif ($_SESSION['Office'] == 'SITE ADMIN') {
		header("location:admin/admin");
		exit();
	}
	elseif ($_SESSION['Office'] == 'PRESIDENT') {

		header("location:vpaa/vpaa");
		exit();
	}
	elseif ($_SESSION['Office'] == 'PRESIDENT1') {
header("location:president/dashboard");
exit();
	}
	elseif ($_SESSION['Office'] == 'PRESIDENT2') {

header("location:president/dashboard");
exit();
	}
	elseif ($_SESSION['Office'] == 'VPAA') {

		header("location:vpaa/vpaa");
		exit();
	} 
	elseif ($_SESSION['Office'] == 'VPABM') {
		header("location:vpaa/vpaa");
		exit();
	}
	elseif ($_SESSION['Office'] == 'VPRET') {
		header("location:vpaa/vpaa");
		exit();
	} 
	elseif ($_SESSION['Office'] == 'VPAA1') {

		header("location:vpaa/dashboard");
		exit();
	} 
	elseif ($_SESSION['Office'] == 'VPAA2') {

		header("location:vpaa/dashboard");
		exit();
	} 
	elseif ($_SESSION['Office'] == 'VPABM1') {

		header("location:vpabm/dashboard");
		exit();
	}
	elseif ($_SESSION['Office'] == 'VPABM2') {

		header("location:vpabm/dashboard");
		exit();
	}
	elseif ($_SESSION['Office'] == 'VPRET1') {
		header("location:vpret/dashboard");
		exit();
	} 
	elseif ($_SESSION['Office'] == 'VPRET2') {
		header("location:vpret/dashboard");
		exit();
	} 
	elseif ($_SESSION['Office'] == 'PROCUREMENT') {
		header("location:procurement/dashboard");
		exit();
	} else {
		header("location:others/track");
		exit();
	}
}


?>