<?php

//action.php

include('../db_connect.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{	
        try{
     
            $query = "INSERT INTO marks (id_mark,mark_name,id_factory) VALUES (NULL,?,?)";
			$statement = $connect->prepare($query);
			$name=$_POST["name_mrk"];
			$name_fc=$_POST["name_factory"];
		    $statement->execute(array($name,$name_fc));
             echo '<p>Запись добавлена!</p>';
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $connect = null;
	}
	if($_POST["action"] == "fetch_single")
	{
        try{
		$query = "SELECT mark_name, name_factory,id_mark,city,B.id_factory FROM marks as A  LEFT OUTER JOIN factory_list as B ON A.id_factory=B.id_factory  WHERE id_mark = ?
		";
        $statement = $connect->prepare($query);
        $id_fc=$_POST['id'];
		$statement->execute(array($id_fc));
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['name_mrk'] = $row['mark_name'];
			$output['name_factory'] = $row['id_factory'];
		}
        echo json_encode($output);
         }
         catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $connect = null;
	}
	if($_POST["action"] == "update")
	{
		$query = "UPDATE marks
		SET mark_name = ?, 
		id_factory = ? 
		WHERE id_mark= ?
		";
		$statement = $connect->prepare($query);
		$id=$_POST['hidden_id'];
		$name=$_POST['name_mrk'];
		$name_fc=$_POST['name_factory'];
		$statement->execute(array($name,$name_fc,$id));
		echo '<p>Запись обновлена!</p>';
	}
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM marks WHERE id_mark = ?";
		$statement = $connect->prepare($query);
		$id=$_POST["id"];
		$statement->execute(array($id));
		echo '<p>Запись удалена!</p>';
	}
}

?>