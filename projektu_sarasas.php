<?php
$mode='Projektu sarasas';
$uri = 'http://localhost/Bendras%20projektas/';
include 'header.php';
?>
<!--<a href="<//?= $uri.'projektu_sarasas.php' ?>">Projektų sąrašas(Jono)</a><br>-->
<!--<a href="<//?= $uri.'projektu_sarasas.php?m=new' ?>">Prideti nauja</a><br>-->
<?php
if (isset ($_GET['m'])){
    $sql = "INSERT INTO projektu_sarasas (pavadinimas, Biudzetas)
    VALUES ('".$_GET['Pavadinimas']."', '".$_GET['Biudzetas']."')";
    
    if (mysqli_query($conn, $sql)) {
       echo "New record created successfully";
    } else {
       echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    //echo 'prideti nauja';
    exit;
}
?>
  <form style = "padding: 20px;" action= "projektu_sarasas.php" method="get">
  <h3>Projekto pavadinimas</h3><input type="text" name="Pavadinimas" value=""><br>
  <h3>Biudzetas</h3><input type="text" name="Biudzetas" value=""><br><br>
  <input type="submit" name="m" value="Prideti">
  </form>
  
<?php
if (!empty($_POST)) {
$id = key($_POST);
$id = str_replace ('id_', '', $id);
// sql to delete a record
$sql = "DELETE FROM projektu_sarasas WHERE id = $id";
if (mysqli_query($conn, $sql)) {
//   echo "Record deleted successfully";
} else {
   echo "Error deleting record: " . mysqli_error($conn);
}
}
/*
$sql = "CREATE TABLE projektu_sarasas (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  projektas VARCHAR(30) NOT NULL,
  Biudzetas VARCHAR(30) NOT NULL,
  id, Pavadinimas, reg_date VARCHAR(50),
  reg_date TIMESTAMP
  )";
  $sql = "SELECT id, projektas, Biudzetas FROM projektu_sarasas LIMIT 20;
  $result = mysqli_query($conn, $sql);
*/
$sql = "SELECT Pavadinimas, Biudzetas, id FROM projektu_sarasas ORDER BY Biudzetas ASC LIMIT 20";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
?>
<form style = "padding: 20px;" action = "projektu_sarasas.php" method = "post">
<?php
while($row = mysqli_fetch_assoc($result)) {
 echo "Projektas:".$row["id"]. " " . $row["Pavadinimas"]. " " . $row["Biudzetas"].'<input type="submit" name = id_'.$row["id"].' value = "Trinti">' . "<br>";
}
} else {
echo "0 results";
}
?>
</form>
<?php
?>