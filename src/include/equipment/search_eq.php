<?php
include('../db_connect.php');//подключаемся моудль с настройкой бд
session_start();
if(isset($_POST["search_type"]) && isset($_POST["search_param"]))//проверяем пришло со страни нуженые переменные
{
	$param='';
	if($_POST["search_type"] == 0) //проверяем критерий поиска (0-Код ТМЦ,1-Наименвоание,2-Количество)
	{	
         $param.='id_tmc';
		
	}
	if($_POST["search_type"] == 1){
		$param.='name';

	}
	if($_POST["search_type"] == 2){
		$param.='count';
	}
    $query = "SELECT id_tmc,name,gost,mark_name,name_factory,count,A.id_mark FROM equipment_list as A 
	LEFT OUTER JOIN marks as B ON A.id_mark=B.id_mark 
	LEFT OUTER JOIN factory_list as C ON C.id_factory=B.id_factory  WHERE $param LIKE ? ORDER BY id_tmc";//sql запрос на выборку с параметром
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
	        foreach($result as $row) //выводим результат запроса в табличку
	        {
				$output.='<tr>
				<td aria-label="Код ТМЦ">'.$row['id_tmc'].'</td>
				<td aria-label="Наименование">'.$row['name'].'</td>
				<td aria-label="ГОСТ,ТУ">'.$row['gost'].'</td>
				<td aria-label="Марка">'.$row['mark_name'].'</td>
				<td aria-label="Изготовитель">'.$row['name_factory'].'</td>
				<td aria-label="Кол-во">'.$row['count'].'</td>';
				if($_SESSION['type']==0){
					$output.='
					<td>
						<button type="button" class="edit"  id="'.$row['id_tmc'].'">Ред.</button>
						 <input type="hidden" name="table_id" id="table_id" value="0"/>
					</td>
					<td>
						<button type="button" class="delete"  id="'.$row['id_tmc'].'">Удал.</button>
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
		        <td colspan="8" align="center">По вашему запросу ничего не найдено</td>
	        </tr>
	        ';
        }
        echo $output;

}
else{
	$output .= '
	<tr>
		<td colspan="8" align="center">Произошла ошибка</td>
	</tr>
	';
	echo $output;
}



?>