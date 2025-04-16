<?php

session_start();
session_unset();
session_destroy();
header("Location: http://localhost/modern-eats/auth/login.php");
exit();


?>