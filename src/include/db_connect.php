<?php

//database_connection.php

$connect = new PDO("mysql:host=localhost;dbname=tmc;charset=utf8;", "root", "");
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>