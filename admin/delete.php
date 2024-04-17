<?php
include '../database.php';
session_start();
// Assuming you have a database connection established in $conn

if (isset($_POST['delete_user'])) {
    $user_id_to_delete = $_POST['id'];

    // Display a confirmation dialog using JavaScript
    echo "<script>
            var userConfirmed = confirm('Are you sure you want to delete this user?');
            if (userConfirmed) {
                window.location.href = 'delete?id=$user_id_to_delete&confirmed=1';
            } else {
                window.location.href = 'admin';
            }
          </script>";
}

// Check for confirmation parameter and perform the deletion
if (isset($_GET['confirmed']) && $_GET['confirmed'] == 1) {
    $user_id_to_delete = $_GET['id'];

    // Perform the deletion query
    $delete_query = "DELETE FROM tbl_users WHERE ID = $user_id_to_delete";
    $delete_result = $conn->query($delete_query);

    if ($delete_result) {
        echo "<script>alert('Deleted Account');</script>";
        echo "<script>window.location.href = 'admin'</script>";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}
?>
