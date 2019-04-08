<?php
    session_start();
    $_SESSION["RegState"] = 5;
    header("Location: ../index.php");
    die()
?>