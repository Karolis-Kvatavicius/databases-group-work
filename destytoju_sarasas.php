<?php

$mode='Dėstytojų sąrašas';
$uri = 'http://localhost/PHP/tema10/';
include 'header.php';

?>

<form action="destytoju_sarasas.php" method="get">
<input type="text" name="vardas" value=""/>
<input type="text" name="pavarde" value=""/><br>
<input type="submit" name="m" value="Pasirinkti">
</form>

<br>

<?php
if(isset($_GET['m'])) {

$sql = "INSERT INTO destytoju_sarasas (Vardas, Pavarde)
VALUES ('".$_GET['vardas']."', '".$_GET['pavarde']."')";
    
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//echo 'prideti nauja';
exit;
}
    
if (!empty($_POST)) {
    
$id = key($_POST);
$id = str_replace ('id_', '', $id);
    

$sql = "DELETE FROM destytoju_sarasas WHERE id = $id";
    
if (mysqli_query($conn, $sql)) {
//   echo "Record deleted successfully";
} else {
   echo "Error deleting record: " . mysqli_error($conn);
}

}

$sql = "SELECT id, Vardas, Pavarde FROM destytoju_sarasas ORDER BY Pavarde LIMIT 500";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
?>

<form action="destytoju_sarasas.php" method="POST">

<?php
   while($row = mysqli_fetch_assoc($result)) {
       echo "Dėstytojas: " .$row["id"]. " ". $row["Vardas"]. " " . $row["Pavarde"]. " ". '<input type="submit" name=id_'.$row["id"].' value="DELETE">'. '<br>';
   }
} else {
   echo "0 results";
}
?>
</form>

<?php

include 'footer.php';

?>