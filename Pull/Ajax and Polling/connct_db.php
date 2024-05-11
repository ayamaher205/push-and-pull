<?php 
include('./base.php');
function connect_to_database(){
     try {
        $dsn= "mysql:host=localhost;dbname=php_users;port=3306";
        $db=  new PDO($dsn, 'php', 'root');
        return $db;
    }catch (Exception $e) {
    echo "<p class='text-danger'>Connection failed</p> ";
}
}

?>
