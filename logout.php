<?php
session_start();
session_unset();
    $_SESSION['name'] = NULL;
    $_SESSION['email'] = NULL;
    $_SESSION['role'] =  NULL;
header("Location: index.php");
?>
