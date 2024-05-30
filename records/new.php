<!DOCTYPE html>
<?php
include '../database.php';
session_start();

if(!isset($_SESSION['Office'])){header("Location: ../index1");}

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
    
        $message = "Subject: $subjec <br>
        Reference: $reference <br><br>
        
        Dear $campus Campus,<br><br>


        I hope this message finds you well.<br><br>

        Records office would like to notify you that a document that is under your jurisdiction at the moment is being processed. Please be advised that it will be handled as soon as it is finished and submitted in compliance with our set protocols.<br><br>

        Please get in touch if you have any questions or need help with any part of this process.<br><br>

        Thank you for your attention to this matter.";
        

        
    
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
        ?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <style type="text/css">
        <!--
        p {margin: 0; padding: 0;}

        .ft10{font-size:15px;font-family:Times;color:#000000;}
        .ft11{font-size:14px;font-family:Times;color:#ffffff;}
        .ft12{font-size:14px;font-family:Times;color:#000000;}
        .ft13{font-size:13px;font-family:Times;color:#000000;}
        .ft14{font-size:14px;font-family:Times;color:#001f5f;}
        .ft15{font-size:14px;font-family:Times;color:#001f5f;}
        .ft16{font-size:14px;font-family:Times;color:#001f5f;}
        .ft17{font-size:23px;font-family:Times;color:#001f5f;}
        .ft18{font-size:15px;font-family:Times;color:#000000;}
        .ft19{font-size:13px;font-family:Times;color:#ffffff;}
        .ft110{font-size:13px;font-family:Times;color:#ffffff;}
        .ft111{font-size:13px;font-family:Times;color:#000000;}
        .ft112{font-size:11px;font-family:Times;color:#000000;}
        .ft113{font-size:14px;line-height:23px;font-family:Times;color:#000000;}
        .ft114{font-size:14px;line-height:20px;font-family:Times;color:#000000;}
        .ft115{font-size:13px;line-height:19px;font-family:Times;color:#000000;}
        .ft116{font-size:14px;line-height:18px;font-family:Times;color:#001f5f;}
        .ft117{font-size:14px;line-height:20px;font-family:Times;color:#001f5f;}
        .ft118{font-size:14px;line-height:18px;font-family:Times;color:#001f5f;}
        .ft119{font-size:14px;line-height:19px;font-family:Times;color:#001f5f;}
        .ft120{font-size:14px;line-height:20px;font-family:Times;color:#001f5f;}
        .ft121{font-size:14px;line-height:19px;font-family:Times;color:#000000;}
        .ft122{font-size:13px;line-height:20px;font-family:Times;color:#000000;}
        .ft123{font-size:14px;line-height:22px;font-family:Times;color:#000000;}

        #page1-div {
            position: relative;
            width: 210mm; /* Width of A4 paper */
            height: 297mm; /* Height of A4 paper */
            margin: 0 auto; /* Center the element horizontally */
        }

        @media print {
            #page1-div {
                margin-left: 0; /* Remove left margin when printing */
                height: auto 0 !important; /* Adjust height to match content */
                margin-top: 50px;
            }
        }
        -->
    </style>
</head>
<body bgcolor="#A0A0A0" vlink="blue" link="blue">
<div id="page1-div">
    <img width="918" height="1188" src="target001.png" alt="background image"/>
<p style="position:absolute;top:57px;left:108px;white-space:nowrap" class="ft10">&#160;</p>
<p style="position:absolute;top:57px;left:162px;white-space:nowrap" class="ft10">&#160;</p>
<p style="position:absolute;top:57px;left:216px;white-space:nowrap" class="ft10">&#160;</p>
<p style="position:absolute;top:57px;left:270px;white-space:nowrap" class="ft10">&#160;&#160;</p>
<p style="position:absolute;top:54px;left:278px;white-space:nowrap" class="ft11">&#160;</p>
<p style="position:absolute;top:74px;left:459px;white-space:nowrap" class="ft10">&#160;</p>
<p style="position:absolute;top:96px;left:108px;white-space:nowrap" class="ft113">&#160;<br/>&#160;</p>
<p style="position:absolute;top:1077px;left:108px;white-space:nowrap" class="ft114">&#160;<br/>&#160;</p>
<p style="position:absolute;top:1107px;left:689px;white-space:nowrap" class="ft115"><b>&#160;<br/>Contact&#160;No.&#160;(0&#160;44)&#160;940-9980&#160;<br/>Email:&#160;sanisidro@neust.edu.ph&#160;<br/>www.neust.edu.ph&#160;</b></p>
<p style="position:absolute;top:1129px;left:45px;white-space:nowrap" class="ft117"><i><b>&#160;<br/></b>Transforming&#160;Communities through&#160;Science&#160;and&#160;Technology&#160;&#160;<br/><b>&#160;</b></i></p>
<p style="position:absolute;top:47px;left:155px;white-space:nowrap; font-size:15px;" class="ft120"><i>&#160;<br/></i><b>Cabanatuan&#160;City, Nueva&#160;Ecija, Philippines&#160;<br/>ISO 9001:2015&#160;CERTIFIED&#160;<br/>&#160;<br/></b><i>&#160;</i></p>
<p style="position:absolute;top:26px;left:155px;white-space:nowrap; font-size:15px;" class="ft16"><b>Republic&#160;of&#160;the&#160;Philippines&#160;</b></p>
<p style="position:absolute;top:46px;left:155px;white-space:nowrap; font-size:20px;" class="ft17"><b>NUEVA&#160;ECIJA&#160;UNIVERSITY&#160;OF&#160;SCIENCE&#160;AND&#160;TECHNOLOGY&#160;</b></p>
<p style="position:absolute;top:78px;left:155px;white-space:nowrap" class="ft16"><b>&#160;</b></p>
<p style="position:absolute;top:123px;left:320px;white-space:nowrap" class="ft18"><b>DTS&#160;–&#160;DOCUMENT&#160;TRACKING&#160;SYSTEM</b>&#160;</p>
<p style="position:absolute;top:146px;left:460px;white-space:nowrap" class="ft19"><i>&#160;</i></p>
<p style="position:absolute;top:178px;left:460px;white-space:nowrap" class="ft19"><i>&#160;</i></p>
<p style="position:absolute;top:210px;left:460px;white-space:nowrap" class="ft110">&#160;</p>
<p style="position:absolute;top:241px;left:460px;white-space:nowrap" class="ft111">&#160;</p>
<p style="position:absolute;top:139px;left:108px;white-space:nowrap" class="ft12">&#160;</p>
<p style="position:absolute;top:139px;left:162px;white-space:nowrap" class="ft12">&#160;</p>
<p style="position:absolute;top:139px;left:216px;white-space:nowrap" class="ft12">&#160;</p>
<p style="position:absolute;top:139px;left:270px;white-space:nowrap" class="ft12">&#160;&#160;&#160;</p>
<p style="position:absolute;top:173px;left:108px;white-space:nowrap" class="ft12">&#160;</p>
<p style="position:absolute;top:207px;left:108px;white-space:nowrap" class="ft12">&#160;</p>
<p style="position:absolute;top:241px;left:108px;white-space:nowrap" class="ft121">&#160;<br/>&#160;<br/>&#160;</p>
<p style="position:absolute;top:660px;left:144px;white-space:nowrap; font-size:15px;" class="ft119"><i>&#160;<br/></i><b>Cabanatuan&#160;City, Nueva&#160;Ecija, Philippines&#160;<br/>ISO&#160;9001:2015&#160;CERTIFIED&#160;<br/>&#160;<br/></b><i>&#160;</i></p>
<p style="position:absolute;top:640px;left:144px;white-space:nowrap; font-size:15px;" class="ft16"><b>Republic&#160;of&#160;the&#160;Philippines&#160;</b></p>
<p style="position:absolute;top:657px;left:144px;white-space:nowrap; font-size:20px;" class="ft17"><b>NUEVA&#160;ECIJA&#160;UNIVERSITY&#160;OF&#160;SCIENCE&#160;AND&#160;TECHNOLOGY&#160;</b></p>
<p style="position:absolute;top:691px;left:144px;white-space:nowrap" class="ft16"><b>&#160;</b></p>
<p style="position:absolute;top:739px;left:320px;white-space:nowrap" class="ft18"><b>DTS&#160;–&#160;DOCUMENT&#160;TRACKING&#160;SYSTEM</b>&#160;</p>

<p style="font-weight: bold; font-size: 30px; position:absolute;text-align:center;top:160px;left:260px;white-space:nowrap" class="ft18"">RECORDS OFFICE RECEIPT <br> <br> <br></p>
<p style="position:absolute;text-align:center;top:220px;left:340px;white-space:nowrap" class="ft18">

<?php 

// $campus = "SAN ISIDRO";
// $fromoffice ="CICT";
// $subjec ="CICT";
// $cdate ="02/05/2024";
// $reference ="NEUST12365812838123";


        echo "CAMPUS: $campus<br>";
        echo "OFFICE: $fromoffice<br>";
        echo "SUBJECT: $subjec<br>";
        echo "DATE: $cdate<br>";
		echo "<img src='barcode?codetype=Code39&size=40&text=$reference&print=true'>";
?>

</p>

<p style="position:absolute;top:440px;right:-20px;white-space:nowrap" class="ft123">________________________________&#160;</p>
<p style="position:absolute;top:460px;right:10px;white-space:nowrap" class="ft18">

Signature over printed name

</p>

<p style="position:absolute;top:794px;left:451px;white-space:nowrap" class="ft19">&#160;</p>
<p style="position:absolute;top:826px;left:451px;white-space:nowrap" class="ft110">&#160;</p>
<p style="position:absolute;top:857px;left:451px;white-space:nowrap" class="ft111">&#160;</p>
<p style="position:absolute;top:514px;left:689px;white-space:nowrap" class="ft122"><b>&#160;<br/>Contact&#160;No.&#160;(0&#160;44)&#160;940-9980&#160;<br/>Email:&#160;sanisidro@neust.edu.ph&#160;<br/>www.neust.edu.ph&#160;</b></p>
<p style="position:absolute;top:606px;left:689px;white-space:nowrap" class="ft112"><b>&#160;</b></p>
<p style="position:absolute;top:536px;left:45px;white-space:nowrap" class="ft117"><i><b>&#160;<br/></b>Transforming&#160;Communities through&#160;Science&#160;and&#160;Technology&#160;&#160;<br/><b>&#160;</b></i></p>
<p style="position:absolute;top:602px;left:14px;white-space:nowrap" class="ft123">-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------&#160;</p>


<p style="font-weight: bold; font-size: 30px; position:absolute;text-align:center;top:775px;left:335px;white-space:nowrap" class="ft18"">CLIENT RECEIPT <br> <br> <br></p>
<p style="position:absolute;text-align:center;top:835px;left:340px;white-space:nowrap" class="ft18">

<?php 

// $campus = "SAN ISIDRO";
// $fromoffice ="CICT";
// $subjec ="CICT";
// $cdate ="02/05/2024";
// $reference ="NEUST12365812838123";


        echo "CAMPUS: $campus<br>";
        echo "OFFICE: $fromoffice<br>";
        echo "SUBJECT: $subjec<br>";
        echo "DATE: $cdate<br>";
        echo "<img src='barcode?codetype=Code39&size=40&text=$reference&print=true'>";
?>

</p>

<p style="position:absolute;top:1030px;right:-20px;white-space:nowrap" class="ft123">________________________________&#160;</p>
<p style="position:absolute;top:1050px;right:10px;white-space:nowrap" class="ft18">

Signature over printed name

</p>

</div>
</body>
</html>