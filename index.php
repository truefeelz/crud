<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>БД ТМЦ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="lib/css/main.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/solid.css" integrity="sha384-r/k8YTFqmlOaqRkZuSiE9trsrDXkh07mRaoGBMoDcmA58OHILZPsk29i2BsFng1B" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/fontawesome.css" integrity="sha384-4aon80D8rXCGx9ayDt85LbyUHeMWd3UiBaWliBlJ53yzm9hqN21A+o1pqoyK04h+" crossorigin="anonymous">
</head>
<body>
 <header class="page_top">
     <div class="menu-ico">
        <i class="fas fa-bars fa-2x""></i>
     </div>
     <div class="user">
            <?php
                if(isset($_SESSION['name'])){
                    echo '<p class="logout">Вы вошли,как '.$_SESSION['name'].'<br><a href="logout.php"> Выйти</a><p>';
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
        <h2>Добро пожаловать в базу данных ТМЦ</h2>
    </div>    
 </main>   
<script src="lib\js\jquery-3.3.1.min.js"></script> 
<script src="lib\js\jquery.maskedinput.min.js"></script>
<script src="lib/js/main.js"></script>
</body>
</html>
