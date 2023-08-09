<?php
if(!isset($_COOKIE)) {
    header('Location: homepage.php');
    } else if ($_COOKIE["admin"]) {
        header('Location: ./admin/admindash.php');
    }else{
         header('Location: cardetails.php');
     }
?>

