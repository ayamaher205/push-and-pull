<?php
    require('./crudOpertaions.php');
    var_dump($_POST);
    $name=$_POST['name'];
    $email=$_POST['email'];
    $room=$_POST['Room'];
    $image=$_FILES['file']['name'];
    $password=md5($_POST['password']);
    $id=$_POST['id'];
update_user($id, $name, $email, $image, $password, $room);
header("Location:./users.php");
?>
