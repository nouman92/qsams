<?php
ini_set('display_errors', 0);
error_reporting(0);
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
@ob_start();
//if(session_status()!=PHP_SESSION_ACTIVE)
  session_start();
require './system/initialize.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Nouman Anjum">
    <link rel="shortcut icon" href="vendor/img/favicon.png">
    <title>QASP-Assets Management</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/css/styles.css" rel="stylesheet">
    <link href="vendor/fonts/JuliusSansOne-Regular.ttf" rel="preconnect">


</head>
<body id="page-top" class="cc-content-parent">
    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container topbar navigation-colors">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll ">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#toggle_menue">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="/" ><img width="200px" height="" src="./vendor/img/qs-solar-logo.jpg" alt="Assets Management" /></a>
                <!-- <a class="navbar-brand" href="/bootstrap">Assets Management</a> -->
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="toggle_menue">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="/"></a>
                    </li>
                    <?php if(!isset($_SESSION["email"])){?>
                      <li class="page-scroll">
                          <a href="about.php">About</a>
                      </li>
                      <li class="page-scroll">
                          <a href="/">Login</a>
                      </li>
                    <?php } ?>
                    <?php if(isset($_SESSION["email"])){?>
                      <li class="page-scroll">
                          <a href="records.php">Assets</a>
                      </li>
                      <li class="page-scroll">
                          <a href="profile.php">Profile</a>
                      </li>
                      <li class="page-scroll">
                          <a href="logout.php">Logout</a>
                      </li>
                    <?php }?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
