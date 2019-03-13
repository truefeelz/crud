<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Регистрация</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="lib/css/main.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/fontawesome.css" integrity="sha384-4aon80D8rXCGx9ayDt85LbyUHeMWd3UiBaWliBlJ53yzm9hqN21A+o1pqoyK04h+" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="lib/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/solid.css" integrity="sha384-r/k8YTFqmlOaqRkZuSiE9trsrDXkh07mRaoGBMoDcmA58OHILZPsk29i2BsFng1B" crossorigin="anonymous">
</head>
<body>
<header class="page_top">
     <div class="menu-ico">
        <i class="fas fa-bars fa-2x""></i>
     </div>
     <div class="user">
            <?php
                if(isset($_SESSION['name'])){
                    echo '<p class="logout">Вы вошли,как '.$_SESSION['name'].'<br><a href="src/include/logout.php"> Выйти</a><p>';
                }
                else{  
                header('Location:login.php');
                }
            ?>
    </div>
 </header>
 <nav class="menu-left">
     <ul>
         <h2>Меню</h2>
        <li><a href="index.php">Главная</a></li>
        <li><a href="equipment.php">Список оборудования</a></li>
        <li><a href="factory.php">Изготовители</a></li>
        <li><a href="marks.php">Марки</a></li>
        <?php
            include 'src/include/check_menu.php'
        ?>
     </ul>           
    </nav>    
 <main>
     <div class="container">
			<form  class="auth_form"  id="reg_form" method="post">
                <ul class="flex-outer">
                <li>
                    <h3>Регистрация</h3>
                     <hr style="color:black; width:100%;">
                </li>
                <li>     
                     <label>Логин пользователя</label>
                     <input type="text" name="login" id="login" placeholder="user123">
                </li>
                <li>     
                     <label>Пароль</label>
                     <input type="password" name="pass" id="pass" placeholder="1234567">
                </li>
                 <li>
                     <label>ФИО пользователя</label>
                     <input type="text" name="fio" id="fio" placeholder="Иванов Иван Иванович">
                </li>
                 <li>  
                    <div class="response" id="response"></div>
                    <input type="submit" name="reg_submit" id="reg_submit" value="Регистрация">
                    </li>
                </ul>
			</form>
    </div>
 </main>   
 <script src="lib\js\jquery-3.3.1.min.js"></script> 
<script src="lib\js\jquery.maskedinput.min.js"></script>   
<script src="lib\js\jquery-ui.min.js"></script>
 <script src="lib\js\main.js"></script>
</body>
</html>