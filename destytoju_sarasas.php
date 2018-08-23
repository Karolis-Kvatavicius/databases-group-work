<?php

$uri = 'http://localhost/grupes-darbas-db/';
$mode = 'Destytoju sarasas';

include 'header.php';


$sql = "SELECT Vardas, Pavarde FROM destytoju_sarasas ORDER BY Pavarde DESC LIMIT 20";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // kiekvieną eilutę atskirai
  while($row = mysqli_fetch_assoc($result)) {
      echo "<p><b>Vardas: </b>" . $row["Vardas"]. "<b> Pavardė: </b>" . $row["Pavarde"]. "</p>";
  }
} else {
  echo "<p>0 results</p>";
}

include 'footer.php';