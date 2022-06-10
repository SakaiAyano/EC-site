<?php
session_start();
$id = $_SESSION['id'];
?>

<html>
    <h1>Hello!!</h1>
    <p><?php echo $id ?></p>
</html>