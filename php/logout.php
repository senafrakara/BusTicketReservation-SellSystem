<?php

session_start();
unset($_SESSION['ID']);
session_destroy();
header("Location: loginpage.php");

session_start();

?>