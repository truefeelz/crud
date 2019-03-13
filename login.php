<?php
session_start();
if(isset($_SESSION['name'])){
    header('Location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Вход</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="lib/css/main.css" />
    <script src="lib\js\jquery-3.3.1.min.js"></script> 
    <script src="lib\js\jquery.maskedinput.min.js"></script>   
</head>
<body>
 <header class="page_top">
 <div class="menu-ico">
    <h2>Авторизация</h2>
    </div>
 </header>
 <main>
    <div class="container">
        <form  class="auth_form" id="login_form" method="POST">
        <ul class="flex-outer">
        <li>
        <h3>Авторизуйтесь</h3>
        <hr style="color:black; width:100%;">
        </li>
        <li>
            <label>Введите логин</label>
            <input type="text" name="login" id="login" placeholder="user123">
        </li>
        <li>
            <label>Укажите пароль</label>
            <input type="password" name="password" id="password" placeholder="1337">
        </li>
        <li>
        <div class="response" id="response"></div>
            <input type="submit" name="log_submit" id="log_submit" value="Войти">
     
        </li>
        </ul>
        
    </form> 
  
 </main>   
 <script src="lib/js/main.js"></script>
</body>
</html>