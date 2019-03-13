<?php


session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Заводы</title>
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
        <div id="user_dialog">
        <form method="post" id="user_form">
            <ul class="flex-outer">
                <li>
                <label>Введите название завода</label>
                <input type="text" name="name_fc" id="name_fc" placeholder="ЗАО &#34Арматэк&#34">
            </li>
            <li>
                <label>Укажите город</label>
                <input type="text" name="city_fc" id="city_fc" placeholder="Челябинск">
            </li>
            <li>
                <label>Введите улицу</label>
                <input type="text" name="address_fc" id="address_fc" placeholder="ул. Енисейская, 47">
            </li>
            <li>
                <label>Контактный телефон</label>
                <input type="tel" name="tel_fc" id="tel_fc" placeholder="+7 (___) ___-__-__">
            </li>
            <li>   
                <input type="hidden" name="page_id" id="page_id" value="1"/>  
                <input type="hidden" name="action" id="action" value="insert" />
				<input type="hidden" name="hidden_id" id="hidden_id" /> 
                <hr style="color:black; width:100%;">
                <div class="errors" id="errors"></div> 
            </li>
            <li> 
                <input type="submit" name="form_action" id="form_action"  value="Insert" />    
            </li>  
            </form> 
        </div>
    <div id="action_alert" title="Action"></div>
		<div id="delete_confirmation" title="Потверждение удаления">
		    <p>Вы уверены,что хотите удалить?</p>
		</div>
    <div class="search">
            <form class="inline" id="search_form">
                <label>Поиск по критерию</label>
                <input id="search_id" name="search_id" type="hidden" value="1">
                <select name="search_type" id="search_type">
                    <option value="0">Код завода</option>
                    <option value="1">Название</option>
                    <option value="2">Город</option>
                 </select>
                <label>Значение</label>
                <input type="text" name="search_param" id="search_param">
                <button type="button" name="search" id="search">Найти</button>   
                <button type="button" id="print_fc">Вывести все</button>
                <?php
                if($_SESSION['type']==0){
                     echo '<button type="button" name="add" id="add" >Добавить</button>';
                }
                ?>  
                <div class="response" id="response"></div>  
            </form>             
        </div>
        <div class="print">
            <table class="print_db">
                <thead>
                    <tr>
                        <th>Код завода</th>
                        <th>Название</th>
                        <th>Город</th>
                        <th>Адрес</th>
                        <th>Телефон</th>
                        <th colspan="2">Действие</th>
                    </tr>    
                </thead>
                <tbody id="print">
                </tbody>
            </table>
        </div>
    </div>    
 </main>   
 <script src="lib\js\jquery-3.3.1.min.js"></script> 
 <script src="lib\js\jquery-ui.min.js"></script>
<script src="lib\js\jquery.maskedinput.min.js"></script>
 <script src="lib/js/main.js"></script>
</body>
</html>