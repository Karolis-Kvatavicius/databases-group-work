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

if(isset($_GET['selected_project'])) {
  $sql = "UPDATE projektu_sarasas SET DestytojoID = NULL WHERE id=".$_GET['selected_project'];
  mysqli_query($conn, $sql);
  unset($sql);
  header('Location:'.$uri.'projektai.php?uri='.$uri.'&teacherOnProject=true');
  exit;
}

//DESTYTOJU SARASAS
if(isset($_GET['project'])) {

  //DESTYTOJO ATLIEKAMI PROJEKTAI
  if (isset($_GET['teachersProjects'])) {
    echo '<h2 style="color: brown; text-align: center;">Dėstytojo projektai</h2>';
    $sql = "SELECT DestytojoID, Pavadinimas, Biudzetas FROM projektu_sarasas WHERE DestytojoID = ".$_GET['teachersProjects'];
    $result = mysqli_query($conn, $sql);

    echo '<div style="">';
    if (mysqli_num_rows($result) > 0) {
      echo '<a href="'.$uri.'projektai.php?uri='.$uri.'&project='.$_GET['project'].'" style="text-decoration: none; border: 1px solid darkblue; margin: 20px; display: block; width: 120px; text-align: center;">Grįžti atgal</a>';
      while($row = mysqli_fetch_assoc($result)) {
          echo '<div style="border-bottom: 1px solid black;">';
          echo '<p style="padding: 10px; box-sizing: border-box; display: inline-block;"><b>Dėstytojo ID: </b>'.$row['DestytojoID'].'<b> Pavadinimas: </b>' . $row['Pavadinimas']. '<b> Biudzetas: </b>' . $row['Biudzetas'].'</p>';
          echo '</div>';
      }
    } else {
      echo '<a href="'.$uri.'projektai.php?uri='.$uri.'&project='.$_GET['project'].'" style="text-decoration: none; border: 1px solid darkblue; margin: 20px; display: block; width: 120px; text-align: center;">Grįžti atgal</a>';
      echo "<p>0 results</p>";
    }
    echo '</div>';

  } else {
    echo '<h2 style="color: brown; text-align: center;">Dėstytojų sąrašas</h2>';
    $sql = "SELECT Vardas, Pavarde, id FROM destytoju_sarasas";
    $result = mysqli_query($conn, $sql);

    echo '<div style="">';
    if (mysqli_num_rows($result) > 0) {
      echo '<a href="'.$uri.'projektai.php?uri='.$uri.'" style="text-decoration: none; border: 1px solid darkblue; margin: 20px; display: block; width: 120px; text-align: center;">Grįžti atgal</a>';
      while($row = mysqli_fetch_assoc($result)) {
          echo '<div style="border-bottom: 1px solid black;">';
          echo '<p style="padding: 10px; box-sizing: border-box; display: inline-block;"><b>Dėstytojo ID: </b>'.$row['id'].'<b> Vardas: </b>' . $row['Vardas']. '<b> Pavarde: </b>' . $row['Pavarde']. 
          '<a href="'.$uri.'projektai.php?uri='.$uri.'&project='.$_GET['project'].'&teacher='.$row['id'].'" style="text-decoration: none; border: 1px solid darkblue; margin-left: 20px;">Priskirti</a></p>';
          echo '<a href="'.$uri.'projektai.php?uri='.$uri.'&project='.$_GET['project'].'&teachersProjects='.$row['id'].'" style="text-decoration: none; border: 1px solid darkblue; margin-left: 20px; display: inline-block;">Dėstytojo projektai</a>';
          echo '</div>';
      }
    } else {
      echo "<p>0 results</p>";
    }
    echo '</div>';
  }

//UZIMTI PROJEKTAI
} else if(isset($_GET['teacherOnProject'])) {
  echo '<h2 style="color: brown; text-align: center;">Užimti projektai</h2>';
  $sql = "SELECT projektu_sarasas.id, projektu_sarasas.Pavadinimas, projektu_sarasas.Biudzetas, projektu_sarasas.DestytojoID, destytoju_sarasas.Vardas, destytoju_sarasas.Pavarde 
  FROM destytoju_sarasas INNER JOIN projektu_sarasas ON projektu_sarasas.DestytojoID = destytoju_sarasas.id";
  $result = mysqli_query($conn, $sql);
echo '<div style="">';
if (mysqli_num_rows($result) > 0) {
  echo '<a href="'.$uri.'projektai.php?uri='.$uri.'" style="text-decoration: none; border: 1px solid darkblue; margin: 20px; display: block; width: 120px; text-align: center;">Grįžti atgal</a>';
  while($row = mysqli_fetch_assoc($result)) {
      echo '<div style="border-bottom: 1px solid black;">';
      echo '<p style="padding: 10px; box-sizing: border-box;"><b>Projekto ID: </b>'.$row['id'].'<b> Projekto pavadinimas: </b>'.$row['Pavadinimas'].'<b> Projekto Biudžetas: </b>'.$row['Biudzetas'].
      '<b> Dėstytojo ID: </b>'.$row['DestytojoID'].'<b> Vardas: </b>' . $row['Vardas']. '<b> Pavarde: </b>'.$row['Pavarde'].'
      <a href="'.$uri.'projektai.php?uri='.$uri.'&selected_project='.$row['id'].'" style="text-decoration: none; border: 1px solid darkblue; margin-left: 20px;"> Anuliuoti priskyrimą</a></p>';
      echo '</div>';
  }

} else {
  echo '<a href="'.$uri.'projektai.php?uri='.$uri.'" style="text-decoration: none; border: 1px solid darkblue; margin: 20px; display: block; width: 120px; text-align: center;">Grįžti atgal</a>';
  echo "<p>0 results</p>";
}
echo '</div>';

//PROJEKTU PUSLAPIS
} else {

if(isset($_GET['sortBudget'])) {
echo '<h2 style="color: brown; text-align: center;">Laisvų projektų sąrašas</h2>';
$sql = "SELECT Pavadinimas, Biudzetas, id FROM projektu_sarasas ORDER BY Biudzetas DESC";
$result = mysqli_query($conn, $sql);
echo '<div style="">';
if (mysqli_num_rows($result) > 0) {
  echo '<a href="'.$uri.'projektai.php?uri='.$uri.'&teacherOnProject=true" style="text-decoration: none; border: 1px solid darkblue;
  margin: 20px; display: inline-block; width: 120px; text-align: center;">Užimti projektai</a>';
  echo '<a href="'.$uri.'projektai.php?uri='.$uri.'" style="text-decoration: none; border: 1px solid darkblue;
  margin: 20px; display: inline-block; width: 260px; text-align: center;">Anuliuoti rikiavimą</a>';
  while($row = mysqli_fetch_assoc($result)) {
      echo '<div style="border-bottom: 1px solid black;">';
      echo '<p style="padding: 10px; box-sizing: border-box;"><b>Projekto ID: </b>'.$row['id'].'<b> Pavadinimas: </b>' . $row['Pavadinimas']. '<b> Biudzetas: </b>' . $row['Biudzetas']. 
      '<a href="'.$uri.'projektai.php?uri='.$uri.'&project='.$row['id'].
      '" style="text-decoration: none; border: 1px solid darkblue; margin-left: 20px;"> Priskirti dėstytoją</a></p>';
      echo '</div>';
  }

} else {
  echo "<p>0 results</p>";
}
echo '</div>';

} else {
echo '<h2 style="color: brown; text-align: center;">Laisvų projektų sąrašas</h2>';
$sql = "SELECT Pavadinimas, Biudzetas, id FROM projektu_sarasas WHERE DestytojoID IS NULL";
$result = mysqli_query($conn, $sql);
echo '<div style="">';
if (mysqli_num_rows($result) > 0) {
  echo '<a href="'.$uri.'projektai.php?uri='.$uri.'&teacherOnProject=true" style="text-decoration: none; border: 1px solid darkblue;
  margin: 20px; display: inline-block; width: 120px; text-align: center;">Užimti projektai</a>';
  echo '<a href="'.$uri.'projektai.php?uri='.$uri.'&sortBudget=true" style="text-decoration: none; border: 1px solid darkblue;
  margin: 20px; display: inline-block; width: 260px; text-align: center;">Rikiuoti pagal didžiausią biudžetą</a>';
  while($row = mysqli_fetch_assoc($result)) {
      echo '<div style="border-bottom: 1px solid black;">';
      echo '<p style="padding: 10px; box-sizing: border-box;"><b>Projekto ID: </b>'.$row['id'].'<b> Pavadinimas: </b>' . $row['Pavadinimas']. '<b> Biudzetas: </b>' . $row['Biudzetas']. 
      '<a href="'.$uri.'projektai.php?uri='.$uri.'&project='.$row['id'].
      '" style="text-decoration: none; border: 1px solid darkblue; margin-left: 20px;"> Priskirti dėstytoją</a></p>';
      echo '</div>';
  }

} else {
  echo "<p>0 results</p>";
}
echo '</div>';

}
?>

<?php
include 'footer.php';
}