<?php

//action.php

include('../db_connect.php');
session_start();

if(isset($_POST["search_type"]) && isset($_POST["search_param"]))
{
	$param='';
	if($_POST["search_type"] == 0)
	{	
         $param.='id_factory';
		
	}
	if($_POST["search_type"] == 1){
		$param.='name_factory';

	}
	if($_POST["search_type"] == 2){
		$param.='city';
	}
    $query = "SELECT id_factory,name_factory,city,address,telephone FROM factory_list
	WHERE $param LIKE ? ORDER BY id_factory";
	$statement = $connect->prepare($query);
	$param_text=$_POST['search_param'];
	if($_POST["search_type"] == 0){
		$statement->bindValue(1, $param_text,PDO::PARAM_INT);
	}
	else{
		$statement->bindValue(1, "%$param_text%", PDO::PARAM_STR);
	}
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output='';
	if($total_row > 0)
	{
		foreach($result as $row){
			$output.='<tr>
			<td aria-label="Код завода">'.$row['id_factory'].'</td>
		   <td aria-label="Название">'.$row['name_factory'].'</td>
		   <td aria-label="Город">'.$row['city'].'</td>
		   <td aria-label="Адрес">'.$row['address'].'</td>
		   <td aria-label="Телефон">'.$row['telephone'].'</td>';
		   if($_SESSION['type']==0){
			   $output.='
			   <td>
				   <button type="button" class="edit"  id="'.$row['id_factory'].'">Ред.</button>
					<input type="hidden" name="table_id" id="table_id" value="1"/>
			   </td>
			   <td>
				   <button type="button" class="delete"  id="'.$row['id_factory'].'">Удал.</button>
				   </td>
			   </tr>';
			}
			else{
			   $output.='</tr>';  
			}
		}
	}
	else
	{
		$output .= '
		<tr>
			<td colspan="7" align="center">По вашему запросу ничего не найдено</td>
		</tr>
		';
	}
	echo $output;

}
else{
	$output .= '
	<tr>
		<td colspan="7" align="center">Произошла ошибка</td>
	</tr>
	';
	echo $output;
}



?>