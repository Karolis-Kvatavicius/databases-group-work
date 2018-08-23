<?php
$uri = 'http://localhost/grupes-darbas-db/';
$mode = 'Password change';

include 'header.php';
?>

<a style="font-size: 18px; font-weight: bold; padding: 30px; display: block;" href="<?= $uri.'index.php' ?>">Get back to index page</a>
<form style="padding: 30px;" action="passwordChange.php" method="POST">
    <input type="text" name="new_password" placeholder="Your new password here">
    <input type="submit" name="set_password" value="Set new password">
</form>

<?php
if (isset($_POST['set_password']) && $_POST['new_password'] != '') {
    $sql = "UPDATE users SET slaptazodis='".$_POST['new_password']."' WHERE Vardas='".$_SESSION['username']."'";
   if(mysqli_query($conn, $sql)) {
    echo '<p style="color: green;">Password change was successful !!!</p>';
    unset($sql); 
   } else {
    echo '<p style="color: red;">Password update error !!!</p>';
    unset($sql);
   }
   
} 

if(isset($_POST['set_password']) && $_POST['new_password'] == '') {
    echo '<p style="color: red;">New password can not be empty !!!</p>';
}

include 'footer.php';