<?php

//action.php

include('../db_connect.php');
session_start();

if(isset($_POST["search_type"]) && isset($_POST["search_param"]))
{
	$param='';
	if($_POST["search_type"] == 0)
	{	
         $param.='id_mark';
		
	}
	if($_POST["search_type"] == 1){
		$param.='mark_name';

	}
	if($_POST["search_type"] == 2){
		$param.='name_factory';
	}
    $query = "SELECT mark_name, name_factory,id_mark,city,B.id_factory FROM marks as A 
    LEFT OUTER JOIN factory_list as B ON A.id_factory=B.id_factory WHERE $param LIKE ? ORDER BY id_mark";
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
            $output.= '<tr>
                          <td aria-label="Код марки">'.$row['id_mark'].'</td>
                         <td aria-label="Название">'.$row['mark_name'].'</td>
                         <td aria-label="Изготовитель">'.$row['name_factory'].'</td>
                         <td aria-label="Город">'.$row['city'].'</td>';
                         if($_SESSION['type']==0){
                            $output.='
                            <td>
                                <button type="button" class="edit"  id="'.$row['id_mark'].'">Ред.</button>
                                 <input type="hidden" name="table_id" id="table_id" value="2"/>
                            </td>
                            <td>
                                <button type="button" class="delete"  id="'.$row['id_mark'].'">Удал.</button>
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
            <td colspan="5" align="center">По вашему запросу ничего не найдено</td>
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