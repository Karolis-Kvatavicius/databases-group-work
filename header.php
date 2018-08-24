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
 
$uri = $_GET['uri']??'';

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
<body style = "margin: 0px;  background-color:rgba(211, 211, 211, 0.14901960784313725);">

<div style="font-size: 20px; display: flex; justify-content: space-around; background-color:  rgb(245, 243, 243);">
<img src="logo.png"> 
<a href="<?= $mode?>"></a><br>
<a  style="margin-top: 18px;" href="<?= $uri.'destytoju_sarasas.php?uri='.$uri ?>">Dėstytojų sąrašas(Mariaus)</a><br>
<br>
<a style="margin-top: 18px;" href="<?= $uri.'projektu_sarasas.php?uri='.$uri ?>">Projektų sąrašas(Jono)</a><br>
<br>
<a style="margin-top: 18px;" href="<?= $uri.'projektai.php?uri='.$uri ?>">Projektai(Karolis)</a><br>
<br><br>
<a style="margin-top: 18px;"  href="<?= $uri.'passwordChange.php?uri='.$uri ?>"> Keisti_slaptazodi</a>
<br>
<br>
<a style="margin-top: 18px;"  href="<?= $uri.'login.php?logout=1&uri='.$uri ?>">Logout</a>
</div>

<?php if(!isset($_GET['link'])){?>
<div>
<a style="font-size: 18px; font-weight: bold; padding: 30px; display: block;" href="<?= $uri.'index.php?uri='.$uri.'&link=1' ?>">Get back to index page</a>
</div>
<?php
}