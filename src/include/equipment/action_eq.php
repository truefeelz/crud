<?php
//action.php
include('../db_connect.php');//подключаем модуль с настройкой бд
if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")//проверяем чему равна переменна action со страницы(insert-добавить запись,fetch-single-вывод в форму редактирования,
									//update-обновить запись,delete-удаление записи)
	{	
        try{
     
            $query = "INSERT INTO equipment_list (id_tmc,name,gost,id_mark,count) VALUES (NULL,?,?,?,?)";//запрос на добавление в таблицу
            $statement = $connect->prepare($query);
            $name_eq=$_POST['name_eq'];
            $gost=$_POST['gost'];
            $id_mark=$_POST['name_mark'];
            $count=$_POST['count'];
		    $statement->execute(array($name_eq,$gost,$id_mark,$count));
             echo '<p>Запись добавлена!</p>';
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $connect = null;
	}
	if($_POST["action"] == "fetch_single")//проверяем чему равна переменна action со страницы(insert-добавить запись,fetch-single-вывод в форму редактирования,
	//update-обновить запись,delete-удаление записи)
	{
        try{
		$query = "SELECT id_tmc,name,gost,mark_name,name_factory,count,A.id_mark FROM equipment_list as A 
        LEFT OUTER JOIN marks as B ON A.id_mark=B.id_mark 
        LEFT OUTER JOIN factory_list as C ON C.id_factory=B.id_factory  WHERE id_tmc = ?";//запрос на вывод записи в форму редактирования
        $statement = $connect->prepare($query);
        $id_tmc=$_POST['id'];
		$statement->execute(array($id_tmc));
		$result = $statement->fetchAll();
		foreach($result as $row)//передаем записи на страницу
		{
			$output['name_eq'] = $row['name'];
			$output['gost'] = $row['gost'];
			$output['count'] = $row['count'];
			$output['markName'] = $row['id_mark'];
          
		}
        echo json_encode($output);
         }
         catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $connect = null;
	}
	if($_POST["action"] == "update")//проверяем чему равна переменна action со страницы(insert-добавить запись,fetch-single-вывод в форму редактирования,
	//update-обновить запись,delete-удаление записи)
	{
		$query = "UPDATE equipment_list 
		SET name = ?, 
		gost = ? ,
		id_mark=?,
		count=?
		WHERE id_tmc = ?";//запрос на обновления данных в таблице
		$statement = $connect->prepare($query);
		$id=$_POST['hidden_id'];
		$name=$_POST['name_eq'];
		$gost=$_POST['gost'];
		$count=$_POST['count'];
		$id_mark=$_POST['name_mark'];
		$statement->execute(array($name,$gost,$id_mark,$count,$id));
		echo '<p>Запись обновлена!</p>';
	}
	if($_POST["action"] == "delete")//проверяем чему равна переменна action со страницы(insert-добавить запись,fetch-single-вывод в форму редактирования,
	//update-обновить запись,delete-удаление записи)
	{
		$query = "DELETE FROM equipment_list WHERE id_tmc = ?";//sql запрос на удаление выбранной строки
		$statement = $connect->prepare($query);
		$id=$_POST["id"];
		$statement->execute(array($id));
		echo '<p>Запись удалена!</p>';
	}
}

?>

