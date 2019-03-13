<?php
if(isset($_POST['login'])){//проверяем наличие нужной нам переменной

    if($_POST['login']=='' || $_POST['pass']=='' || $_POST['fio']==''){//проверяем на пустые поля
        $output='<span class="danger">Поля не могут быть пустыми!</span>';
    }
    else{
        include('db_connect.php');
        $query="SELECT * FROM users WHERE login= ? ";//запрос на выборку с указанным логином
        $statement=$connect->prepare($query);
        $login=$_POST['login'];
        $statement->execute(array($login));
        $total_row=$statement->rowCount();
        $output='';
    
        if($total_row>0){//если такой логин уже есть

            $output='<span class="danger">Данный логин уже существует</span>';
        
        }
        else{
            $query = "INSERT INTO users (id_user,login,password,fio,type) VALUES (NULL,?,?,?,?)";//запрос на добавление записи
            $statement = $connect->prepare($query);
            $password=password_hash($_POST['pass'],PASSWORD_DEFAULT);//шифрования пароля
            $fio=$_POST['fio'];
            $type=1;
		    $statement->execute(array($login,$password,$fio,$type));
            $output='<span class="success">Регистрация успешна!</span>';
        
        }
    
    
    }
    echo $output;
}
else{
    $output='<span class="danger">Произошла ошибка</span>';
    echo $output;
}
?>
