<?php

$uri = 'http://localhost/grupes-darbas-db/';
$mode = 'Projektu sarasas';

include 'header.php';


$sql = "SELECT Pavadinimas, Biudzetas FROM projektu_sarasas ORDER BY Biudzetas DESC LIMIT 20";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // kiekvieną eilutę atskirai
  while($row = mysqli_fetch_assoc($result)) {
      echo "<p><b>Pavadinimas: </b>" . $row["Pavadinimas"]. "<b> Biudžetas: </b>" . $row["Biudzetas"]. "</p>";
  }
} else {
  echo "<p>0 results</p>";
}

include 'footer.php';