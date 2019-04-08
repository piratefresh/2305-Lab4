<?php
require_once("config.php");
session_start();

$Acode = $_SESSION['Acode'];
$Email = $_SESSION['Email'];

print "Got Email($Email) Acode($Acode) \n";
 // Connect to DB
$conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['Password1'])) {
    $Password = $_POST['Password1'];
    $Password2 = $_POST['Password2'];

    if ($Password == $Password2) {
        $query = "UPDATE Visitors SET Password='$Password' WHERE Email='$Email' AND Acode='$Acode'";
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_array($result)){
            $FirstName = $row['FirstName'];
            $LastName = $row['LastName'];
        }
        if ($result) { // Update Success
            $_SESSION["RegState"] = 4;
            header("Location: ../member.php?Email=$Email&FirstName=$FirstName&LastName=$LastName");
            die();
        } else {
            $_SESSION["RegState"] = -5;
            $_SESSION["ErrorMsg"] = "Reset Password Failed";
            header("Location: ../index.php");
            die();
        }
    }
}
exit();
?>