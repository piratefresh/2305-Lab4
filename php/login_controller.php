<?php
require_once("config.php");
session_start();

$Email = $_POST['Email'];
$Password1 = $_POST['Password1'];
/* Captcha */
$captcha=$_POST['g-recaptcha-response'];
/* if the captcha is not checked we exit the script */
if(!$captcha){
    $_SESSION["RegState"] = -7;
    $_SESSION["ErrorMsg"] = "Please Check Recaptcha" . mysqli_error($conn);
    header("Location: ../index.php");
    die();
}
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Ld8IZQUAAAAANpNHGn8DyxvGwq5nehjAZoYWcKu&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
    if($response.success==false)
    {
        echo 'You are spammer!';
    } else   {
        print "Got Email($Email) Password($Password1) \n";
        // Connect to DB
       $conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
       if (!$conn) {
           die("Connection failed: " . mysqli_connect_error());
       }
       // Build a query
       $query = "SELECT * FROM Visitors WHERE Email='$Email' AND Password='$Password1'";
       $status = mysqli_query($conn, $query);
       while($row=mysqli_fetch_array($status)){
           $FirstName = $row['FirstName'];
           $LastName = $row['LastName'];
       }
       if ($status) {
           $rows = mysqli_num_rows($status);
           $cookie_name = "user";
           setcookie($cookie_name, $Password1, time() + (86400 * 30), "/");
           if ($rows == 1) {// Exact match. Logged In.
               $_SESSION["RegState"] = 4;
               header("Location: ../member.php?Email=$Email&FirstName=$FirstName&LastName=$LastName");
               die();
           }
       } else {
           $_SESSION["RegState"] = -6;
           $_SESSION["ErrorMsg"] = "Login Failed" . mysqli_error($conn);
           header("Location: ../index.php");
           die();
       }
       $_SESSION["RegState"] = -4;
       $_SESSION["ErrorMsg"] = "Database access failure:" . mysqli_error($conn);
       header("Location: ../index.php");
       die();
    }  


?>