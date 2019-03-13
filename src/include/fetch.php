<?php

//fetch.php

include("db_connect.php");//подключаем моудль с настройками бд
session_start();

if(isset($_POST["pageId"]))
{
    if($_POST["pageId"] == 0) //проверка на номер страницы (0-обурдование,1-заводы,2-марки)
	{
        $query = "SELECT id_tmc,name,gost,mark_name,name_factory,count FROM equipment_list as A 
        LEFT OUTER JOIN marks as B ON A.id_mark=B.id_mark 
        LEFT OUTER JOIN factory_list as C ON C.id_factory=B.id_factory ORDER BY id_tmc";            //sql запрос на вывод всех данных с со связими всех таблиц
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $total_row = $statement->rowCount();
        $output='';
        if($total_row > 0)
        {
	        foreach($result as $row) //выводим данные в таблицу
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

    if($_POST["pageId"] == 1)
	{
        $query="SELECT id_factory,name_factory,city,address,telephone FROM factory_list ORDER BY id_factory";
        $statement = $connect->prepare($query);
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
		        <td colspan="8" align="center">По вашему запросу ничего не найдено</td>
	        </tr>
	        ';
        }
        echo $output;

    }
    if($_POST["pageId"] == 2){

         $query="SELECT mark_name, name_factory,id_mark,city,B.id_factory FROM marks as A  LEFT OUTER JOIN factory_list as B ON A.id_factory=B.id_factory";
         $statement = $connect->prepare($query);
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
    
}

else{
    $output .= '
    <tr>
        <td colspan="8" align="center">Произошла ошибка!</td>
    </tr>
    ';
    echo $output;
}

?>
