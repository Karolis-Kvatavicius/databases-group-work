<?php
$uri = $_GET['uri'];
$mode = 'Password change';

include 'header.php';
?>

<form style="padding: 30px;" action="passwordChange.php" method="POST">
    <input type="text" name="new_password" placeholder="Your new password here">
    <input type="submit" name="set_password" value="Set new password">
</form>
<style>

</style>

<?php
if (isset($_POST['set_password']) && $_POST['new_password'] != '') {
    $sql = "UPDATE users SET slaptazodis='".$_POST['new_password']."' WHERE Vardas='".$_SESSION['username']."'";
   if(mysqli_query($conn, $sql)) {
    echo '<p style="color: green;">Password change was successful !!!</p>';
    unset($sql);
    session_destroy();
    header('Location:'.$uri.'passwordChange.php?uri='.$uri);
   } else {
    echo '<p style="color: red;">Password update error !!!</p>';
    unset($sql);
   }
   
} 

if(isset($_POST['set_password']) && $_POST['new_password'] == '') {
    echo '<p style="color: red;">New password can not be empty !!!</p>';
    header('Location:'.$uri.'passwordChange.php?uri='.$uri);
}

include 'footer.php';