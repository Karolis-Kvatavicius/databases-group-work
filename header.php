<?php
session_start();
if(!isset($_SESSION['sesija']) || !$_SESSION['sesija'] == true){
    header('Location:'.$uri.'login.php?uri='.$uri);
    exit;
}
 if(isset($_POST['logout'])) {
   session_destroy();
   header('Location:'.$uri.'login.php');
   exit;
 }
$servername = "localhost";
$username = 'root';
$password = '123';

$conn = mysqli_connect($servername, $username, $password, 'projektai');
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $mode?></title>
</head>
<body>
<header>
</header>
