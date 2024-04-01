<?php
include '../database.php';
session_start();


use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../vendor/autoload.php';


	$reference = $_POST['reference'];
	$campus = $_POST['campus'];
	$cdate = $_POST['cdate'];
	$channel = $_SESSION['allowedoffice'];
	$fromoffice = $_POST['fromoffice'];
	$othersoffice = $_POST['othersoffice'];
	$fromperson = $_POST['fromperson'];
	$subjec = $_POST['subject'];
	$docutype = $_POST['docutype'];
	$vouchertype = $_POST['vouchertype'];
	$voucherno = $_POST['voucherno'];
	$voucheramt = $_POST['voucheramt'];
	$gmail = $_POST['gmail'];

	$currentdate = date('y-m-d');

	$president = isset($_POST['president']) ? $_POST['president'] : 'no';
	$vpaa = isset($_POST['vpaa']) ? $_POST['vpaa'] : 'no';
	$vpabm = isset($_POST['vpabm']) ? $_POST['vpabm'] : 'no';
	$vpret = isset($_POST['vpret']) ? $_POST['vpret'] : 'no';
	$pr = isset($_POST['pr']) ? $_POST['pr'] : 'no';

	//Automatic creation of REFERENCE NUMBER

	// Ofice number

	if ($reference == "-"){

		$queryoffice = "SELECT * FROM tbl_office WHERE OfficeName = '".$fromoffice."'";
		$resultoffice = $conn->query($queryoffice);
		$numrowsoffice = $resultoffice->num_rows;

		while ($rowsoffice = $resultoffice->fetch_assoc()) 
		{
			$officeid = $rowsoffice['OfficeID'];
		}

		$officeid = str_pad($officeid, 2, 0, STR_PAD_LEFT);
		$currentdate = date("Ymd");

		//incrementing number

		$querydate = "SELECT * FROM tbl_numbering";
		$resultdate = $conn->query($querydate);
		$numrowsdate = $resultdate->num_rows;

		while ($rowsdate = $resultdate->fetch_assoc()) 
		{
			$nodate = $rowsdate['CDate'];
			$nodate = date_format($nodate,'Ymd');
			$nonumbers = $rowsdate['Numbers'];
		}

		if ($nodate == $currentdate){

			$nonumbers = $nonumbers + 1;
			$nonumbers = str_pad($nonumbers, 3, 0, STR_PAD_LEFT);

		} else {

			$currnumber = 0;

			$dbconn = new PDO("mysql:host=".$servername.";dbname=".$dbname.";", $username, $password);
			$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$queryrep = "UPDATE tbl_numbering SET CDate = :cdate, Numbers = '0'";

			$q = $dbconn->prepare($queryrep);
			$q->execute([':cdate' => $currentdate]);

			$nonumbers = $currnumber + 1;
			$nonumbers = str_pad($nonumbers, 3, 0,
			 STR_PAD_LEFT);

		}	

	}

	if ($vpaa == "yes") {
		$dbconnin = new PDO("mysql:host=".$servername.";dbname=".$dbname.";", $username, $password);
		$dbconnin->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if (isset($_FILES["uploadfile"]["name"])) {
			$uploadValue = "../file/" . $_FILES["uploadfile"]["name"];

			// Insert data into "IN" table
			$queryin = "INSERT INTO tbl_inout (DocInOut, Reference, Campus, Channel, FromOffice, Subject, DocuType, CDate, DocStatus, Upload, Gmail, VoucherType, VoucherNo, VoucherAmt) 
						VALUES ('IN', :reference, :campus, 'VPAA', :fromoffice, :subject, :docutype, :cdate, '-', :upload, :gmail, :vouchertype, :voucherno, :voucheramt)";
			$qin = $dbconnin->prepare($queryin);
			$qin->execute([
				':reference' => $reference,
				':campus' => $campus,
				':fromoffice' => $fromoffice,
				':subject' => $subjec,
				':docutype' => $docutype,
				':cdate' => $cdate,
				':upload' => $uploadValue,
				':gmail' => $gmail,
				':vouchertype' => $vouchertype,
				':voucherno' => $voucherno,
				':voucheramt' => $voucheramt,
			]);
		}

		//for inout add tables - out

		if (isset($_FILES["uploadfile"]["name"])) {
			$uploadValue = "../file/" . $_FILES["uploadfile"]["name"];

		$dbconnout = new PDO("mysql:host=".$servername.";dbname=".$dbname.";", $username, $password);
		$dbconnout->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$queryout = "INSERT INTO tbl_inout SET DocInOut = 'OUT', Upload = :upload, Reference = :reference, Campus = :campus, Channel = 'VPAA', FromOffice = :fromoffice, Subject = :subject, DocuType = :docutype, CDate = :cdate, Gmail = :gmail, VoucherType = :vouchertype, VoucherNo = :voucherno, VoucherAmt = :voucheramt, DocStatus = '-'";

		$qout = $dbconnout->prepare($queryout);
		$qout->execute([':reference' => $reference, ':campus' => $campus, ':upload' => $uploadValue,  ':fromoffice' => $fromoffice, ':subject' => $subjec, ':docutype' => $docutype, ':cdate' => $cdate, ':gmail' => $gmail, ':vouchertype' => $vouchertype, ':voucherno' => $voucherno, ':voucheramt' => $voucheramt]);
	}
}

	if ($vpabm == "yes") {

		//for inout add tables - in

		$dbconnin = new PDO("mysql:host=".$servername.";dbname=".$dbname.";", $username, $password);
		$dbconnin->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if (isset($_FILES["uploadfile"]["name"])) {
			$uploadValue = "../file/" . $_FILES["uploadfile"]["name"];

			// Insert data into "IN" table
			$queryin = "INSERT INTO tbl_inout (DocInOut, Reference, Campus, Channel, FromOffice, Subject, DocuType, CDate, DocStatus, Upload, Gmail, VoucherType, VoucherNo, VoucherAmt) 
						VALUES ('IN', :reference, :campus, 'VPABM', :fromoffice, :subject, :docutype, :cdate, '-', :upload, :gmail, :vouchertype, :voucherno, :voucheramt)";
			$qin = $dbconnin->prepare($queryin);
			$qin->execute([
				':reference' => $reference,
				':campus' => $campus,
				':fromoffice' => $fromoffice,
				':subject' => $subjec,
				':docutype' => $docutype,
				':cdate' => $cdate,
				':upload' => $uploadValue,
				':gmail' => $gmail,
				':vouchertype' => $vouchertype,
				':voucherno' => $voucherno,
				':voucheramt' => $voucheramt,
			]);
		}

		//for inout add tables - out



		if (isset($_FILES["uploadfile"]["name"])) {
			$uploadValue = "../file/" . $_FILES["uploadfile"]["name"];

		$dbconnout = new PDO("mysql:host=".$servername.";dbname=".$dbname.";", $username, $password);
		$dbconnout->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$queryout = "INSERT INTO tbl_inout SET DocInOut = 'OUT', Upload = :upload, Reference = :reference, Campus = :campus, Channel = 'VPABM', FromOffice = :fromoffice, Subject = :subject, DocuType = :docutype, CDate = :cdate, Gmail = :gmail, VoucherType = :vouchertype, VoucherNo = :voucherno, VoucherAmt = :voucheramt, DocStatus = '-'";

		$qout = $dbconnout->prepare($queryout);
		$qout->execute([':reference' => $reference, ':campus' => $campus, ':upload' => $uploadValue,  ':fromoffice' => $fromoffice, ':subject' => $subjec, ':docutype' => $docutype, ':cdate' => $cdate, ':gmail' => $gmail, ':vouchertype' => $vouchertype, ':voucherno' => $voucherno, ':voucheramt' => $voucheramt]);
	}
}

	if ($vpret == "yes") {

		//for inout add tables - in
		$dbconnin = new PDO("mysql:host=".$servername.";dbname=".$dbname.";", $username, $password);
		$dbconnin->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if (isset($_FILES["uploadfile"]["name"])) {
			$uploadValue = "../file/" . $_FILES["uploadfile"]["name"];

			// Insert data into "IN" table
			$queryin = "INSERT INTO tbl_inout (DocInOut, Reference, Campus, Channel, FromOffice, Subject, DocuType, CDate, DocStatus, Upload, Gmail, VoucherType, VoucherNo, VoucherAmt) 
						VALUES ('IN', :reference, :campus, 'VPRET', :fromoffice, :subject, :docutype, :cdate, '-', :upload, :gmail, :vouchertype, :voucherno, :voucheramt)";
			$qin = $dbconnin->prepare($queryin);
			$qin->execute([
				':reference' => $reference,
				':campus' => $campus,
				':fromoffice' => $fromoffice,
				':subject' => $subjec,
				':docutype' => $docutype,
				':cdate' => $cdate,
				':upload' => $uploadValue,
				':gmail' => $gmail,
				':vouchertype' => $vouchertype,
				':voucherno' => $voucherno,
				':voucheramt' => $voucheramt,
			]);
		}
		
		//for inout add tables - out



		if (isset($_FILES["uploadfile"]["name"])) {
			$uploadValue = "../file/" . $_FILES["uploadfile"]["name"];

		$dbconnout = new PDO("mysql:host=".$servername.";dbname=".$dbname.";", $username, $password);
		$dbconnout->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$queryout = "INSERT INTO tbl_inout SET DocInOut = 'OUT', Upload = :upload, Reference = :reference, Campus = :campus, Channel = 'VPRET', FromOffice = :fromoffice, Subject = :subject, DocuType = :docutype, CDate = :cdate, Gmail = :gmail, VoucherType = :vouchertype, VoucherNo = :voucherno, VoucherAmt = :voucheramt, DocStatus = '-'";

		$qout = $dbconnout->prepare($queryout);
		$qout->execute([':reference' => $reference, ':campus' => $campus, ':upload' => $uploadValue,  ':fromoffice' => $fromoffice, ':subject' => $subjec, ':docutype' => $docutype, ':cdate' => $cdate, ':gmail' => $gmail, ':vouchertype' => $vouchertype, ':voucherno' => $voucherno, ':voucheramt' => $voucheramt]);
	}
}

	if ($pr == "yes") {
		$dbconnin = new PDO("mysql:host=".$servername.";dbname=".$dbname.";", $username, $password);
		$dbconnin->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if (isset($_FILES["uploadfile"]["name"])) {
			$uploadValue = "../file/" . $_FILES["uploadfile"]["name"];

			// Insert data into "IN" table
			$queryin = "INSERT INTO tbl_inout (DocInOut, Reference, Campus, Channel, FromOffice, Subject, DocuType, CDate, DocStatus, Upload, Gmail, VoucherType, VoucherNo, VoucherAmt) 
						VALUES ('IN', :reference, :campus, 'PROCUREMENT', :fromoffice, :subject, :docutype, :cdate, '-', :upload, :gmail, :vouchertype, :voucherno, :voucheramt)";
			$qin = $dbconnin->prepare($queryin);
			$qin->execute([
				':reference' => $reference,
				':campus' => $campus,
				':fromoffice' => $fromoffice,
				':subject' => $subjec,
				':docutype' => $docutype,
				':cdate' => $cdate,
				':upload' => $uploadValue,
				':gmail' => $gmail,
				':vouchertype' => $vouchertype,
				':voucherno' => $voucherno,
				':voucheramt' => $voucheramt,
			]);
		}

		//for inout add tables - out

		if (isset($_FILES["uploadfile"]["name"])) {
			$uploadValue = "../file/" . $_FILES["uploadfile"]["name"];

		$dbconnout = new PDO("mysql:host=".$servername.";dbname=".$dbname.";", $username, $password);
		$dbconnout->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$queryout = "INSERT INTO tbl_inout SET DocInOut = 'OUT', Upload = :upload, Reference = :reference, Campus = :campus, Channel = 'PROCUREMENT', FromOffice = :fromoffice, Subject = :subject, DocuType = :docutype, CDate = :cdate, Gmail = :gmail, VoucherType = :vouchertype, VoucherNo = :voucherno, VoucherAmt = :voucheramt, DocStatus = '-'";

		$qout = $dbconnout->prepare($queryout);
		$qout->execute([':reference' => $reference, ':campus' => $campus, ':upload' => $uploadValue,  ':fromoffice' => $fromoffice, ':subject' => $subjec, ':docutype' => $docutype, ':cdate' => $cdate, ':gmail' => $gmail, ':vouchertype' => $vouchertype, ':voucherno' => $voucherno, ':voucheramt' => $voucheramt]);
	}
}

	if ($president == "yes") {

		//for inout add tables - in
		$dbconnin = new PDO("mysql:host=".$servername.";dbname=".$dbname.";", $username, $password);
		$dbconnin->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if (isset($_FILES["uploadfile"]["name"])) {
			$uploadValue = "../file/" . $_FILES["uploadfile"]["name"];

			// Insert data into "IN" table
			$queryin = "INSERT INTO tbl_inout (DocInOut, Reference, Campus, Channel, FromOffice, Subject, DocuType, CDate, DocStatus, Upload, Gmail, VoucherType, VoucherNo, VoucherAmt) 
						VALUES ('IN', :reference, :campus, 'PRESIDENT', :fromoffice, :subject, :docutype, :cdate, '-', :upload, :gmail, :vouchertype, :voucherno, :voucheramt)";
			$qin = $dbconnin->prepare($queryin);
			$qin->execute([
				':reference' => $reference,
				':campus' => $campus,
				':fromoffice' => $fromoffice,
				':subject' => $subjec,
				':docutype' => $docutype,
				':cdate' => $cdate,
				':upload' => $uploadValue,
				':gmail' => $gmail,
				':vouchertype' => $vouchertype,
				':voucherno' => $voucherno,
				':voucheramt' => $voucheramt,
			]);
		}

		//for inout add tables - out


		if (isset($_FILES["uploadfile"]["name"])) {
			$uploadValue = "../file/" . $_FILES["uploadfile"]["name"];

		$dbconnout = new PDO("mysql:host=".$servername.";dbname=".$dbname.";", $username, $password);
		$dbconnout->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$queryout = "INSERT INTO tbl_inout SET DocInOut = 'OUT', Upload = :upload, Reference = :reference, Campus = :campus, Channel = 'PRESIDENT', FromOffice = :fromoffice, Subject = :subject, DocuType = :docutype, CDate = :cdate, Gmail = :gmail, VoucherType = :vouchertype, VoucherNo = :voucherno, VoucherAmt = :voucheramt, DocStatus = '-'";

		$qout = $dbconnout->prepare($queryout);
		$qout->execute([':reference' => $reference, ':campus' => $campus, ':upload' => $uploadValue,  ':fromoffice' => $fromoffice, ':subject' => $subjec, ':docutype' => $docutype, ':cdate' => $cdate, ':gmail' => $gmail, ':vouchertype' => $vouchertype, ':voucherno' => $voucherno, ':voucheramt' => $voucheramt]);
	}
}
	


	
	$dbconnin = new PDO("mysql:host=".$servername.";dbname=".$dbname.";", $username, $password);
	$dbconnin->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if (isset($_FILES["uploadfile"]["name"])) {
		$uploadValue = "../file/" . $_FILES["uploadfile"]["name"];

		// Insert data into "IN" table
		$queryin = "INSERT INTO tbl_inout (DocInOut, Reference, Campus, Channel, FromOffice, Subject, DocuType, CDate, DocStatus, Upload, Gmail, VoucherType, VoucherNo, VoucherAmt) 
					VALUES ('IN', :reference, :campus, 'RECORDS', :fromoffice, :subject, :docutype, :cdate, 'RECEIVED', :upload, :gmail, :vouchertype, :voucherno, :voucheramt)";
		$qin = $dbconnin->prepare($queryin);
		$qin->execute([
			':reference' => $reference,
				':campus' => $campus,
				':fromoffice' => $fromoffice,
				':subject' => $subjec,
				':docutype' => $docutype,
				':cdate' => $cdate,
				':upload' => $uploadValue,
				':gmail' => $gmail,
				':vouchertype' => $vouchertype,
				':voucherno' => $voucherno,
				':voucheramt' => $voucheramt,
		]);
	}



	$queryget = "SELECT * FROM tbl_numbering";
	$resultget = $conn->query($queryget);
	$numrowsget = $resultget->num_rows;

	while ($rowsget = $resultget->fetch_assoc()) 
		{
			$nonumbers = $rowsget["Numbers"];
		}

		$dbconn = new PDO("mysql:host=".$servername.";dbname=".$dbname.";", $username, $password);
		$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$querynumber = "UPDATE tbl_numbering SET Numbers = '" . ($nonumbers + 1) . "'";

		$q = $dbconn->prepare($querynumber);		
		$q->execute();
	
		$subject = "Account Approval";
		$message = "Greetings, $campus <br>
		Reference: $reference <br><br>
		
		Your document is presently undergoing review and processing.";
	
		$mail = new PHPMailer(true);
	
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'docutracking01@gmail.com';
		$mail->Password = 'jiejyzzhrhpjltug';
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;
	
		$mail->setFrom('docutracking01@gmail.com');
		$mail->addAddress($gmail);
		$mail->isHTML(true);
	
		$mail->Subject = $subject;
		$mail->Body = $message;
	
		$mail->send();
	
		if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], '../file/' . $_FILES['uploadfile']['name'])) {
			// File was successfully moved to the "file" directory
		}


		echo "<style>";
		echo "@import url('https://fonts.googleapis.com/css2?family=Lexend&display=swap');";
		echo "* {";
		echo "    font-family: 'Lexend', sans-serif;";
		echo "    font-weight: bold;";
		echo "}";
		echo ".img {";
		echo "    width: 90px;";
		echo "}";
		echo "@media print {";
		echo "    button { display: none; }"; // Hide the button during printing
		echo "}";
		echo "</style>";
	
		echo "<center>";
		echo "<img src='../NEUSTlogo.png' class='img'>";
		echo "<br><br>";
		echo "CAMPUS: $campus<br>";
		echo "OFFICE: $fromoffice<br>";
		echo "SUBJECT: $subjec<br>";
		echo "DATE: $cdate<br>";
		echo "<br><br>";
		echo "<img src='../barcode/barcode?codetype=Code39&size=40&text=$reference&print=true'>";
		echo "<br><br>";
		echo "</center>";
		echo "<br><br>";
		echo "<br><br>";
		echo "<br><br>";
		
		echo "Record: Receipt";
		echo "<center>";
		echo "<br>";
		echo "------------------------------------------------------------------------------------------------";
		echo "</center>";
		echo "Client: Receipt";
		echo "<br><br>";
		echo "<center>";
		echo "<br><br>";
		echo "<img src='../NEUSTlogo.png' class='img'>";
		echo "<br><br>";
		echo "CAMPUS: $campus<br>";
		echo "OFFICE: $fromoffice<br>";
		echo "SUBJECT: $subjec<br>";
		echo "DATE: $cdate<br>";
		echo "<br><br>";
		echo "<img src='../barcode/barcode?codetype=Code39&size=40&text=$reference&print=true'>";
		echo "<br><br>";
		echo "<style>.img {width: 60px;}</style>";
		echo "<button onclick='window.print()'>Print</button>";
		echo "<button onclick='window.history.back()'>Go Back to Previous</button>";
		echo "</center>";
		
?>