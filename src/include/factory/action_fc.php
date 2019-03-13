<?php

//action.php

include('../db_connect.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{	
        try{
     
            $query = "INSERT INTO factory_list (id_factory,name_factory,city,address,telephone) VALUES (NULL,?,?,?,?)";
			$statement = $connect->prepare($query);
			$name=$_POST["name_fc"];
			$city=$_POST["city_fc"];
			$address=$_POST["address_fc"];
			$tel=$_POST["tel_fc"];
		    $statement->execute(array($name,$city,$address,$tel));
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
		$query = "SELECT id_factory,name_factory,city,address,telephone FROM factory_list  WHERE id_factory = ?
		";
        $statement = $connect->prepare($query);
        $id_fc=$_POST['id'];
		$statement->execute(array($id_fc));
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['name_fc'] = $row['name_factory'];
			$output['city_fc'] = $row['city'];
			$output['address_fc'] = $row['address'];
            $output['tel_fc'] = $row['telephone'];
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
		$query = "UPDATE factory_list
		SET name_factory = ?, 
		city = ? ,
		address = ?,
		telephone=?
		WHERE id_factory = ?
		";
		$statement = $connect->prepare($query);
		$id=$_POST['hidden_id'];
		$name=$_POST['name_fc'];
		$city=$_POST['city_fc'];
		$address=$_POST['address_fc'];
		$tel=$_POST['tel_fc'];
		$statement->execute(array($name,$city,$address,$tel,$id));
		echo '<p>Запись обновлена!</p>';
	}
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM factory_list WHERE id_factory = ?";
		$statement = $connect->prepare($query);
		$id=$_POST["id"];
		$statement->execute(array($id));
		echo '<p>Запись удалена!</p>';
	}
}

?>