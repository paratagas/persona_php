<!DOCTYPE html>
<html>
<?php
/**
 * основной файл группы Delete
 * 
 * используется для удаления данных о лицах из БД
 * 
 * @author Евгений Свириденко <partagas@mail.ru>
 * @version Persona 1.0 дата релиза 18.11.2014
 * @copyright Е.Свириденко 2014
 */
 
header("Content-Type: text/html; charset=utf-8");

require_once "../header_int.php";
?>
 
<div id="CONTENT">
	<h2>Удалить данные</h2>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
      <fieldset id="pers_num">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr>
              <td align="left">
                  <input type="submit" value="Вывести всех лиц" />
                  <input type="hidden" name="search_all" value="yes" />
              </td>
            </tr>
         </table>  
      </fieldset>
    </form>
      <br />
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">  
<?php

$action = $_SERVER['PHP_SELF'];

// Проверка условия для поиска всех персон
if(isset($_POST['search_all'])){
    require "../libs/db_conn.lib.php";
    
	$query_select = "SELECT p.persons_id, p.name, p.sur,
                        p.birth, p.passport, i.date_info
			         FROM persons AS p
			         INNER JOIN info_fab AS i
        			 USING (persons_id)
        			 WHERE p.persons_id > 0
        			 ORDER BY p.sur";
    
    $row_cnt = 0;
    if ($result = $db_conn->query($query_select)) {
        $row_cnt = $result->num_rows;
        echo <<<_END_1
        <fieldset id="output_data_group_1">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr class="group_name">
              <td>Полученные данные</td>
            </tr>
            <tr>
              <td>Всего найдено лиц</td>
              <td align="left">
                  $row_cnt
              </td>
            </tr>
            </table>
        </fieldset>
_END_1;
        
        echo "<fieldset class='result_output'>";
        echo "<div class='output'>";
        $cnt = 1;
        for($i=0; $i<$row_cnt; $i++){
            
            $rows = $result->fetch_assoc();
            
            $id = $rows['persons_id'];
            $name = $rows['name'];
            $sur = $rows['sur'];
            
            $birth_orig = $rows['birth'];
            $birth = date_create_from_format('Y-m-d', $birth_orig);
            $birth = date_format($birth, 'd.m.Y');
            
            $passport = $rows['passport'];
            
            $date_info_orig = $rows['date_info'];
            $date_info = date_create_from_format('Y-m-d', $date_info_orig);
            $date_info = date_format($date_info, 'd.m.Y');
            
            $data = <<<_END_2
            <table border="0" cellspacing="10" cellpadding="0">
                <tr class="group_name">
                  <td></td>
                </tr>
                <tr class="group_name">
                  <td>Персона № $cnt:</td>
                </tr>
                
                <tr>
                <td>Имя:</td>
                <td align="left">
                    $name
                </td>
                </tr>
                
                <tr>
                <td>Фамилия:</td>
                <td align="left">
                    $sur
                </td>
                </tr>
                
                <tr>
                <td>Дата рождения:</td>
                <td align="left">
                    $birth
                </td>
                </tr>
                
                <tr>
                <td>Номер паспорта:</td>
                <td align="left">
                    $passport
                </td>
                </tr>
                
                <tr>
                <td>Дата задержания:</td>
                <td align="left">
                    $date_info
                </td>
                </tr>
                
                <tr>
                <td align="left">
                    Отметить для удаления <input type="checkbox" name="delete_list[]" value="$id" />
                </td>
                </tr>
                
            </table>
_END_2;
            
            echo $data;    
            $cnt++;
            
        }// end for
        
        echo "</div>";
        echo "</fieldset>";
    } // endif $result
    
    $db_conn->close(); 
} // endif isset($_POST['search_all'])

// Проверка условия для удаления результатов поиска
if(isset($_POST['clear_all'])){
    header('Location: ' . $_SERVER['PHP_SELF']);
}


// Проверка условия для удаления записи
if(isset($_POST['delete_selected'])){
    $id_list = $_POST['delete_list'];
    if(count($id_list) > 0){
        require "../libs/db_conn.lib.php";
        
        $id_list_str = implode(",", $id_list);
        
        $query_delete_pers = "DELETE FROM persons WHERE persons_id IN ($id_list_str)";
        $query_delete_info_fab = "DELETE FROM info_fab WHERE persons_id IN ($id_list_str)";
        $query_delete_tmc = "DELETE FROM tmc WHERE persons_id IN ($id_list_str)";
        
        $result_pers = $db_conn->query($query_delete_pers);
        $result_info_fab = $db_conn->query($query_delete_info_fab);
        $result_tmc = $db_conn->query($query_delete_tmc);
   	    
        if($result_pers && $result_info_fab && $result_tmc){
            echo "<script type='text/javascript' encoding='UTF-8'> alert ('Выбранные лица успешно удалены');</script>";
        }
        $db_conn->close();
    }else{
        echo "<script type='text/javascript' encoding='UTF-8'> alert ('Вы не выбрали лиц для удаления');</script>";
    }
}

?>
      <br />
      
      <fieldset class="buttons">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr>
              <td align="left">
                  <input type="submit" value="Удалить отмеченных" />
                  <input type="hidden" name="delete_selected" value="yes" />
                  </form>
              </td>
              <td align="left">
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                  <input type="submit" value="Очистить результаты поиска" />
                  <input type="hidden" name="clear_all" value="yes" />
                  </form>
              </td>
            </tr>
          </table>
      </fieldset>
      
      
    </form>
</div>

<?php
require_once "../footer.php";
?>

</body>
</html>
