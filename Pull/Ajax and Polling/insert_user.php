<?php
    require('./crudOpertaions.php');
    $name=$_POST['name'];
    $email=$_POST['email'];
    $room=$_POST['Room'];
    $image=$_FILES['file']['name'];
    $password=md5($_POST['password']);
insert_user($name,$email,$image,$password,$room);
header("Location:./users.php");
?>