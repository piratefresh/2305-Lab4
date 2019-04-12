<?php
require_once("config.php");
session_start();

$Email = $_GET['SetFormEmail'];
$Password1 = $_GET['SetFormPassword1'];
$Password2 = $_GET['SetFormPassword2'];

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
        header("Location: ../index.html");
        die();
    }
    $_SESSION["RegState"] = -5;
    $_SESSION["Message"] = "Could not set password " . mysqli_error($con);
    header("Location: ../index.html");
    die();
}
exit();
