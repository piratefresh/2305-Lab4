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


$Email = $_GET['Email'];

print "Got Email($Email) \n";
$conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$query = "SELECT * FROM Visitors WHERE Email='$Email'";
$result = mysqli_query($conn, $query);
if ($result) {
    $code = rand();
    $datetime = date('Y-m-d H:i:s');
    $query2 = "UPDATE Visitors SET Acode='$code', Adatetime='$datetime'"; // Update Acode with new code
    $result2 = mysqli_query($conn, $query2);
    if ($result2) {
        $data = mysqli_query($conn, $query); // Refind fetch row, as Acode got updated
        $row = mysqli_fetch_assoc($data);
        $Acode = $row['Acode'];
        $FirstName = $row['FirstName'];
        $LastName = $row['LastName'];

    // Visitor found by email, ready to send email and acode
        $Message = "Please click the link to reset password: " . "http://cis-linux2.temple.edu/~tug36870/2305/lab3/passwordreset.php?Email=$Email&Acode=$Acode";

     // Build the PHPMailer object
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2; // Wants to see all errors
            $mail->IsSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "cis105223053238@gmail.com";
            $mail->Password = 'g+N3NmtkZWe]m8"M';
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;
            $mail->SMTPKeepAlive = true;
            $mail->Mailer = "smtp";
            $mail->setFrom("tug36870@temple.edu", "Magnus Nilsen");
            $mail->addReplyTo("tug36870@temple.edu", "Magnus Nilsen");
            $msg = $Message;
            $mail->addAddress($Email, "$FirstName $LastName");
            $mail->Subject = "Reset Password";
            $mail->Body = $msg;
            $mail->send();
            print "Email sent ...< br >";
            $_SESSION["RegState"] = 3;
            $_SESSION["Email"] = $row['Email'];
            $_SESSION["Acode"] = $row['Acode'];
            $_SESSION["Message"] = "Email sent.";
            header("location:../index.php");
            exit();
        } catch (phpmailerException $e) {
            $_SESSION["Message"] = "Mailer error: " . $e->errorMessage();
            $_SESSION["RegState"] = -4;
            print "Mail send failed: " . $e->errorMessage;
        }
    } else {
        print "$email was not registered. <br>";
        $_SESSION["RegState"] = 0;
        header("location:../index.php");
    }
}
?>