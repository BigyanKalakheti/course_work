<?php
if(!isset($_COOKIE["admin"])) {
    header('Location: adminlogin.php');
  } else {
        header('Location: admindash.php');
    }
?>