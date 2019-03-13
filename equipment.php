<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Оборудование</title>
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
     <div id="user_dialog" >
			<form method="post" id="user_form">
                <ul class="flex-outer">
                <li>
                     <label>Название оборудования</label>
                     <input type="text" name="name_eq" id="name_eq" placeholder="Введите имя оборудования">
                </li>
                <li>     
                    <label>ГОСТ/ТУ</label>
                    <input type="text" name="gost" id="gost" placeholder="Введите ГОСТ/ТУ">
                </li>
                <li>    
                    <label>Количество</label>
                    <input type="text" name="count" id="count" placeholder="_ шт.">
                </li> 
                <li>   
                    <label>Выберите марку</label>
                     <select name="name_mark" id="markName">
                    <?php
                        require_once( 'src/include/db_connect.php' );
                        $query="SELECT mark_name, name_factory,id_mark FROM marks as A LEFT OUTER JOIN factory_list as B ON A.id_factory=B.id_factory"; 
                        $statement = $connect->prepare($query);
                        $statement->execute();
                        $result = $statement->fetchAll();
                        $total_row = $statement->rowCount();
                        foreach($result as $row){
                            echo '<option value="'.$row['id_mark'].'">'.$row['mark_name'].'  ('.$row['name_factory'].')</option>';         
                        }        
                         echo '</select>';
                     ?>   
                </li>           			        
                <li>
                    <div class="errors" id="errors"></div> 
                    <input type="hidden" name="page_id" id="page_id" value="0"/>  
                    <input type="hidden" name="hidden_id" id="hidden_id" /> 
                    <input type="hidden" name="action" id="action" value="insert" />
                    <hr style="color:black; width:100%;">
                </li>        
                <li>    
					<input type="submit" name="form_action" id="form_action"  value="Insert" />
                </li>    
                </ul>    
			</form>
		</div>
		<div id="action_alert" title="Action"></div>
		<div id="delete_confirmation" title="Потверждение удаления">
		    <p>Вы уверены,что хотите удалить?</p>
		</div>   
        <div class="search">
            <form class="inline" id="search_form">
                <label>Поиск по критерию</label>
                <input id="search_id" name="search_id" type="hidden" value="0">
                <select name="search_type" id="search_type">
                    <option value="0">Код тмц</option>
                    <option value="1">Наименование</option>
                    <option value="2">Количетсво</option>
                </select>
                <label>Значение</label>
                <input type="text" name="search_param" id="search_param">
                <button type="button" name="search" id="search">Найти</button>   
                <button type="button" id="print_eq">Вывести все</button>
                <?php
                if($_SESSION['type']==0){
                     echo '<button type="button" name="add" id="add" >Добавить</button>';
                }
                ?>    
                <div class="response" id="response"></div>  
            </form>             
        </div>
        <div class="print">
            <table class="print_db" id="eq_table">
                <thead>
                    <tr>
                        <th>Код ТМЦ</th>
                        <th>Наименование</th>
                        <th>ГОСТ,ТУ</th>
                        <th>Марка</th>
                        <th>Изготовитель</th>
                        <th>Кол-во</th>
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
<script src="lib\js\jquery.maskedinput.min.js"></script>   
<script src="lib\js\jquery-ui.min.js"></script>
 <script src="lib\js\main.js"></script>
</body>
</html>