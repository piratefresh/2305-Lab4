<?php
require_once("config.php");
session_start();
$_SESSION["RegState"] = 0;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$Email = $_GET['ResetEmail'];
$OldPassword = $_GET['OldPassword'];
$NewPassword1 = $_GET['NewPassword1'];
$NewPassword2 = $_GET['NewPassword2'];

print "Email ($Email) <br>";

// Connect to DB
$conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
if (!$conn) {
    $_SESSION["RegState"] = -1;
    $_SESSION["Message"] = "Connection failed: " . mysqli_connect_error();
    header("Location: ../index.php");
    die();
}
echo "Connected successfully";
// Build a query
$Acode = rand();
$Rdatetime = date("Y-m-d h:i:s");
// Build a query
if ($NewPassword1 == $NewPassword2) {
    $query = "UPDATE Visitors SET Password='$NewPassword1' where Email='$Email'";
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
