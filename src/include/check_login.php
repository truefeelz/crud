<?php

if(isset($_POST['login'])){

require_once('db_connect.php');//подключаем модуль с настройками БД

session_start();//старт сессии
$query="SELECT * FROM users WHERE login= ? ";//sql запрос на проверку логина

$statement=$connect->prepare($query);
$login=$_POST['login'];
$statement->execute(array($login));

$total_row=$statement->rowCount();

$output='';

if($total_row>0){//если найдено больще чем 0
    $result=$statement->fetchAll();

    foreach ($result as $row) {
        if(password_verify($_POST['password'],$row['password'])){//проверяем пароль

            $_SESSION['name']=$row['login'];
            $_SESSION['type']=$row['type'];
        }
        else{
            $output='<span class="danger">Неверный пароль</span>';

        }
       
    }
}
else{
    $output='<span class="danger">Неверный логин</span>';
}

echo $output;

}


