<?php
require_once("config.php");
session_start();

$Email = $_GET['Email'];
$Password1 = $_GET['Password1'];
$Password2 = $_GET['Password2'];

echo "Got Email($Email) Password($Password1) Confirm Password($Password2) \n";
 // Connect to DB
$conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Build a query
if ($Password1 == $Password2) {
    $query = "UPDATE Visitors SET Password='$Password1' where Email='$Email'";
    $status = mysqli_query($conn, $query);
    if ($status) { // Password saved.
        $_SESSION["RegState"] = 0;
        header("Location: ../index.php");
        die();
    }
    $_SESSION["RegState"] = -5;
    $_SESSION["ErrorMsg"] = "Failed to save password: " . mysqli_error($con);
    header("Location: ../index.php");
    die();
}
exit();
?>