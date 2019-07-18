<?php
session_start();
include_once('pages/functions.php');
$conn=new mysqli('localhost','test','BjVAzm3XR9lYsIgp','travels');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connecttest_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Travel Agency</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style1.css" rel="stylesheet">
</head>
<body>
<div class="container" >
    <div class="row">
        <header class="col-sm-12 col-md-12 col-lg-12">
            <?php include_once("pages/login.php");?>
        </header>
    </div>
    <div class="row">
        <nav class="col-sm-12 col-md-12 col-lg-12">
            <?php include_once('pages/menu.php');?>
        </nav>
    </div>
    <div class="row">
        <section class="col-sm-12 col-md-12 col-lg-12">
            <?php
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page == 1)
                include_once('pages/tours.php');
            if ($page == 2)
                include_once('pages/comments.php');
            if ($page == 3)
                include_once('pages/registration.php');
            if ($page == 4)
                include_once('pages/admin.php');
            if ($page == 6 && isset($_SESSION['radmin']))
                include_once("pages/private.php");
        }
    ?>
        </section>
    </div>
    <div class="row">
        <footer>Step Academy &copy;</footer>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap’s JavaScript
plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>
<!-- Include all compiled plugins (below), or include
individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>