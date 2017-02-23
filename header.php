<?php
ini_set('display_errors', 1);
error_reporting(1);
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));

session_start();
require './system/initialize.php';
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>QASP-Assets Management</title>
    <link type="text/css" href="static/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="static/css/font-awesome.min.css" rel="stylesheet">
    <link type="text/css" href="static/css/styles.css" rel="stylesheet">

    <script src="static/js/jquery-3.1.1.min.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
    <script src="static/js/script.js"></script>
    <link rel="shortcut icon" href="static/favicon.png">
</head>
<body >
<?php if (isset($_SESSION['email'])): ?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/qsams/">Assets Management</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Records</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/qsams/logout.php"><span class="fa fa-sign-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<?php endif ?>
