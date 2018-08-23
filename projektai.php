<?php
$uri = $_GET['uri'];
$mode = 'Projektai';

include 'header.php';

if(isset($_GET['project']) && isset($_GET['teacher'])) {
  $sql = "UPDATE projektu_sarasas SET DestytojoID='".$_GET['teacher']."' WHERE id=".$_GET['project'];
  mysqli_query($conn, $sql);
  unset($sql);
  header('Location:'.$uri.'projektai.php?uri='.$uri);
  exit;
}

if(isset($_GET['project'])) {

    $sql = "SELECT Vardas, Pavarde, id FROM destytoju_sarasas";
    $result = mysqli_query($conn, $sql);

    echo '<div style="">';
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
          echo '<div style="border-bottom: 1px solid black;">';
          echo '<p><b>Dėstytojo ID: </b>'.$row['id'].'<b> Vardas: </b>' . $row['Vardas']. '<b> Pavarde: </b>' . $row['Pavarde']. 
          '<a href="'.$uri.'projektai.php?uri='.$uri.'&project='.$_GET['project'].'&teacher='.$row['id'].'" style="text-decoration: none; border: 1px solid darkblue; margin-left: 20px;"> Priskirti</a></p>';
          echo '</div>';
      }
    } else {
      echo "<p>0 results</p>";
    }
    echo '</div>';



} else if(isset($_GET['teacherOnProject'])) {
  $sql = "SELECT projektu_sarasas.id, projektu_sarasas.Pavadinimas, projektu_sarasas.Biudzetas, projektu_sarasas.DestytojoID, destytoju_sarasas.Vardas, destytoju_sarasas.Pavarde 
  FROM destytoju_sarasas INNER JOIN projektu_sarasas ON projektu_sarasas.DestytojoID = destytoju_sarasas.id";
  $result = mysqli_query($conn, $sql);
echo '<div style="">';
if (mysqli_num_rows($result) > 0) {
  echo '<a href="'.$uri.'projektai.php?uri='.$uri.'" style="text-decoration: none; border: 1px solid darkblue; margin-left: 20px;">Grįžti atgal</a>';
  while($row = mysqli_fetch_assoc($result)) {
      echo '<div style="border-bottom: 1px solid black;">';
      echo '<p><b>Projekto ID: </b>'.$row['id'].'<b> Projekto pavadinimas: </b>'.$row['Pavadinimas'].'<b> Projekto Biudžetas: </b>'.$row['Biudzetas'].
      '<b> Dėstytojo ID: </b>'.$row['DestytojoID'].'<b> Vardas: </b>' . $row['Vardas']. '<b> Pavarde: </b>'.$row['Pavarde'].'</p>';
      echo '</div>';
  }

} else {
  echo "<p>0 results</p>";
}
echo '</div>';


} else {

$sql = "SELECT Pavadinimas, Biudzetas, id FROM projektu_sarasas";
$result = mysqli_query($conn, $sql);
echo '<div style="">';
if (mysqli_num_rows($result) > 0) {
  echo '<a href="'.$uri.'projektai.php?uri='.$uri.'&teacherOnProject=true" style="text-decoration: none; border: 1px solid darkblue; 
  margin-left: 20px;">Užimti projektai</a>';
  while($row = mysqli_fetch_assoc($result)) {
      echo '<div style="border-bottom: 1px solid black;">';
      echo '<p><b>Projekto ID: </b>'.$row['id'].'<b> Pavadinimas: </b>' . $row['Pavadinimas']. '<b> Biudzetas: </b>' . $row['Biudzetas']. 
      '<a href="'.$uri.'projektai.php?uri='.$uri.'&project='.$row['id'].
      '" style="text-decoration: none; border: 1px solid darkblue; margin-left: 20px;"> Priskirti dėstytoją</a></p>';
      echo '</div>';
  }

} else {
  echo "<p>0 results</p>";
}
echo '</div>';
?>

<?php
include 'footer.php';

}