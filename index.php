<?php
$uri = 'http://localhost/grupes-darbas-db/';
$mode='pradžia';


include 'header.php';
?>

<div>
<a href="<?= $uri.'destytoju_sarasas.php' ?>">Destytoju sarasas(Mariaus)</a><br>
<a href="<?= $uri.'projektu_sarasas.php' ?>">Projektu sarasas(Jono)</a><br>

<form action="" method ="POST">
<br>
<input type="submit" name="logout" value ="Atsijungti">
</form>
<a style="display: block; padding-top: 40px;" href="<?= $uri.'passwordChange.php' ?>">Keisti slaptažodį</a>
</div>

<?php
include 'footer.php';