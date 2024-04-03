<?php
include '../database.php';
if(!isset($_SESSION['Office'])){header("Location: ../index1");}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['download_file'])) {
    $id = $_POST['id'];

    // Query the database to get the file information
    $sql = "SELECT `Upload` FROM `doctrack`.`tbl_inout` WHERE ID = $id AND DocInOut = 'IN'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_name = $row['Upload'];

        // Determine the content type based on the file extension
        $content_type = mime_content_type($file_name);

        // Set the appropriate headers for the file download
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment; filename=\"$file_name\"");

        // Output the file data to the browser
        readfile($row['Upload']);

        exit;
    } else {
        echo "File not found.";
    }
}
$conn->close();
?>
