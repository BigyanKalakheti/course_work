<?php
// set the expiration date to one hour ago
setcookie("user","", time() - (86400 * 30),"/");
setcookie("admin","", time() - (86400 * 30),"/");
header('Location: homepage.php');
?>


