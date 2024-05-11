<?php
require('./crudOpertaions.php');
delete_user($_GET['user_id']);
header("Location:./users.php");
?>
