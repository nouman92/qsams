<?php
ini_set('display_errors', 0);
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
error_reporting(0);
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
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>QASP-Assets Management</title>
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link href="css/freelancer.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="page-top" class="index">
    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom affix">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#toggle_menue">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="/qsams/" style="padding:0px;"><img width="200px"src="./img/logo.png" alt="Assets Management" /></a>
                <!-- <a class="navbar-brand" href="/bootstrap">Assets Management</a> -->
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="toggle_menue">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="/qsams"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="refrences.php">Refrences</a>
                    </li>
                    <li class="page-scroll">
                        <a href="about.php">About</a>
                    </li>
                    <li class="page-scroll">
                        <a href="contact.php">Contact</a>
                    </li>
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
