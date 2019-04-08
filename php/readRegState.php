<?php
      session_start();
      $myjson->name = "RegState";
      if (isset($_SESSION["RegState"]))
            $myjson -> value = $_SESSION["RegState"];
      else
            $myjson -> value = 0;
      echo json_encode($myjson);
      exit();
