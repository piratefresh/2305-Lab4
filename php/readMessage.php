<?php
session_start();
$myjson->name = "Message";
if (isset($_SESSION["Message"]))
      $myjson->value = $_SESSION["Message"];
else
      $myjson->value = 0;
echo json_encode($myjson);
exit();
