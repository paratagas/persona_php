<!DOCTYPE html>
<html>
<?php
/**
 * основной файл группы Edit
 * 
 * используется для внесения изменений в данные о лицах в БД
 * 
 * @author Евгений Свириденко <partagas@mail.ru>
 * @version Persona 1.0 дата релиза 18.11.2014
 * @copyright Е.Свириденко 2014
 */
 
header("Content-Type: text/html; charset=utf-8");

require_once "../header_int.php";
require_once "../libs/views.lib.php";
require_once "../libs/sanitize.lib.php";
?>

<div id="CONTENT">
	<h2>Изменить данные</h2>
<fieldset class="buttons">
    <table border="0" cellspacing="10" cellpadding="0">
        <tr>
            <td align="left">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <input type="submit" value="Извлечь лиц из базы данных в список" />
                    <input type="hidden" name="search_all" value="yes" />
                </form>
            </td>
        </tr>
    </table>
</fieldset>

<?php
$action = $_SERVER['PHP_SELF'];

$row_cnt = "";
if(isset($_POST['search_all'])){
    require "../libs/db_conn.lib.php";
    $query_search = "SELECT sur, passport FROM persons 
                        WHERE persons_id > 0
                        ORDER BY sur";
    if ($result = $db_conn->query($query_search)) {
        $row_cnt = $result->num_rows;
    }
    $db_conn->close();
}

/**
   * функция fill_sur_edit($row_cnt, $result)
   * 
   * используется для вывода в select списка найденных лиц
   * вызывается в edit.php
   * 
   * @param integer $row_cnt количество найденных лиц
   * @param object $result результат соединения с БД
*/
function fill_sur_edit($row_cnt, $result){
    for($i=0; $i<$row_cnt; $i++){
        $rows = $result->fetch_assoc();
        $sur_fill_edit = $rows['sur'];
        $passport_fill_edit = $rows['passport'];
        echo "<option value='$sur_fill_edit, $passport_fill_edit'>$sur_fill_edit ($passport_fill_edit)</option>";
    }
}
?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
      <fieldset id="pers_num">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr>
              <td>Фамилия (№ паспорта):</td>
              <td align="left">
                <select name="output_data_sur_select" id="output_data_sur_select">
                    
                    <?php
					//создание списка лиц для редактирования
                        if(isset($_POST['search_all'])){
                            fill_sur_edit($row_cnt, $result);
                        }
                    ?>
                </select>
              </td>
                <td align="left">
                  <input type="submit" value="Выбрать по фамилии" />
                  <input type="hidden" name="fill_form" value="yes" />
                </td>
            </tr>
         </table>  
      </fieldset>
</form>

<?php

// вывод списка лиц для редактирования с полями формы
if(isset($_POST['fill_form'])){
    $sur_passnum = $_POST['output_data_sur_select'];
    $sur_part = strtok($sur_passnum, ",");
    $pass_part = trim(strtok(","));
    $sur_part = sanitize_pass($sur_part);
    $pass_part = sanitize_pass($pass_part);
    require "../libs/db_conn.lib.php";
    $sur_part = $db_conn->real_escape_string($sur_part);
    $pass_part = $db_conn->real_escape_string($pass_part);
    $query_edit = "SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE p.sur = '$sur_part'
            AND p.passport = '$pass_part'
			ORDER BY p.sur";
    $row_cnt_2 = 0;
    if ($result = $db_conn->query($query_edit)) {
        $row_cnt_2 = $result->num_rows;
        for($i=0; $i<$row_cnt_2; $i++){
            $rows = $result->fetch_assoc();
            
            $id = $rows['persons_id'];
            $name = $rows['name'];
            $sur = $rows['sur'];
            $name_lat = $rows['name_lat'];
            $sur_lat = $rows['sur_lat'];
            $birth = $rows['birth'];
            $civil = $rows['civil'];
            $passport = $rows['passport'];
            $number_pers = $rows['number_pers'];
            $number_auto = $rows['number_auto'];
            $date_info = $rows['date_info'];
            $country = $rows['country'];
            $direction = $rows['direction'];
            $ppr = $rows['ppr'];
            $who = $rows['who'];
            $fab = $rows['fab'];
            $sort = $rows['sort'];
            $quant_sel = $rows['quant_sel'];
            $quant = $rows['quant'];
            $price_sel = $rows['price_sel'];
            $price = $rows['price'];
            
            echo <<<_END_1
            <form action="$action" method="POST">
              <fieldset id="pers_edit_group">
                  <table border="0" cellspacing="10" cellpadding="0">
                    <tr class="group_name">
                      <td>Личные данные</td>
                    </tr>
                    <tr>
                      <td>Имя (рус.)</td>
                      <td align="left">
                          <input type="hidden" name="id_edit" value="$id" />
                          <input type="text" name="name_edit" value="$name" size="30" maxlength="30" required="required" />
                      </td>
                    </tr>
                    <tr>
                      <td>Фамилия (рус.)</td>
                      <td align="left">
                          <input type="text" name="sur_edit" value="$sur" size="30" maxlength="30" required="required" />
                      </td>
                    </tr>
                    <tr>
                      <td>Имя (лат.)</td>
                      <td align="left">
                          <input type="text" name="name_lat_edit" value="$name_lat" size="30" maxlength="30" required="required" />
                      </td>
                    </tr> 
                    <tr>
                      <td>Фамилия (лат.)</td>
                      <td align="left">
                          <input type="text" name="sur_lat_edit" value="$sur_lat" size="30" maxlength="30" required="required" />
                      </td>
                    </tr>
                    <tr>
                      <td>Дата рождения (год-месяц-день)</td>
                      <td align="left">
                          <input type="text" name="birth_edit" value="$birth" size="30" maxlength="30" required="required" />
                      </td>
                    </tr>
                    <tr>
                      <td>Гражданство</td>
                      <td align="left">
                          <input type="text" name="civil_edit" value="$civil" size="30" maxlength="30" required="required"/>
                      </td>
                    </tr>
                    <tr>
                      <td>Номер паспорта</td>
                      <td align="left">
                          <input type="text" name="pass_edit" value="$passport" size="30" maxlength="30" required="required" />
                      </td>
                    </tr>
                    <tr>
                      <td>Личный номер</td>
                      <td align="left">
                          <input type="text" name="number_edit" value="$number_pers" size="30" maxlength="30" required="required" />
                      </td>
                    </tr>
                    <tr>
                      <td>Номер авто</td>
                      <td align="left">
                          <input type="text" name="number_auto_edit" value="$number_auto" size="30" maxlength="30" required="required" />
                      </td>
                    </tr>
                  </table>
                  
              </fieldset>
              
              <br />
              
              <fieldset id="info_edit_group">
                  <table border="0" cellspacing="10" cellpadding="0">
                    <tr class="group_name">
                        <td>Информация о задержании</td>
                    </tr>
                    <tr>
                      <td>Дата задержания (год-месяц-день)</td>
                      <td align="left">
                          <input type="text" name="info_date_edit" value="$date_info" size="30" maxlength="30" required="required" />
                      </td>
                    </tr>
                    <tr>
                      <td>Сопредельное государство</td>
                      <td align="left">
                          <input type="text" name="info_country_edit" value="$country" size="30" maxlength="30" required="required" />
                      </td>
                    </tr>
                    <tr>
                      <td>Направление</td>
                      <td align="left">
                          <input type="text" name="info_dir_edit" value="$direction" size="30" maxlength="30" required="required" />
                      </td>
                    </tr>
                    <tr>
                      <td>Пункт пропуска</td>
                      <td align="left">
                          <input type="text" name="info_ppr_edit" value="$ppr" size="30" maxlength="30" required="required" />
                      </td>
                    </tr>
                    <tr>
                      <td>Ведомство</td>
                      <td align="left">
                          <input type="text" name="info_who_edit" value="$who" size="30" maxlength="30" required="required" />
                      </td>
                    </tr>
                  </table>
              
              </fieldset>
              
              <br />
              
              <fieldset id="tmc_edit_group">
                  <table border="0" cellspacing="10" cellpadding="0">
                    <tr class="group_name">
                      <td>Информация о ТМЦ</td>
                    </tr>
                    <tr>
                      <td>Вид ТМЦ</td>
                      <td></td>
                      <td align="left">
                          <input type="text" name="tmc_edit" value="$sort" size="30" maxlength="30" required="required" />
                      </td>
                    </tr>
                    <tr>
                      <td>Количество</td>
                      <td align="left">
                          <input type="text" name="quant_select_edit" value="$quant_sel" size="30" maxlength="30" required="required" />
                      </td>
                      <td align="left">
                          <input type="text" name="quant_edit" value="$quant" size="30" maxlength="30" required="required" />
                      </td>
                    </tr>
                    <tr>
                      <td>Стоимость</td>
                      <td align="left">
                          <input type="text" name="price_select_edit" value="$price_sel" size="30" maxlength="30" required="required" />
                      </td>
                      <td align="left">
                          <input type="text" name="price_edit" value="$price" size="30" maxlength="30" required="required" />
                      </td>
                    </tr>
                  </table>
              </fieldset>
              
              <br />
              
              <fieldset id="fab_edit_group">
                  <table border="0" cellspacing="10" cellpadding="0">
                    <tr class="group_name">
                        <td>Описание правонарушения</td>
                    </tr>
                    <tr>
                      <td align="left">
                          <textarea name="fab_edit_text" cols="65" rows="15" required="required">$fab</textarea>
                      </td>
                    </tr>
                  </table>
              </fieldset>
              
              <fieldset class="buttons">
                  <table border="0" cellspacing="10" cellpadding="0">
                    <tr>
                      <td align="left">
                          <input type="submit" value="Обновить данные лица" />
                          <input type="hidden" name="edit_person" value="yes" />
                      </td>
                    </tr>
                  </table>
              </fieldset>
              
            </form>
_END_1;
        }//end for
        $db_conn->close();  
    }// endif $result
}//endif isset

//редактирование выбранного лица
if(isset($_POST['edit_person'])){
    if(isset($_POST['name_edit']) &&
        isset($_POST['id_edit']) &&
        isset($_POST['sur_edit']) &&
        isset($_POST['name_lat_edit']) &&
        isset($_POST['sur_lat_edit']) &&
        isset($_POST['birth_edit']) &&
        isset($_POST['civil_edit']) &&
        isset($_POST['pass_edit']) &&
        isset($_POST['number_edit']) &&
        isset($_POST['number_auto_edit']) &&
        isset($_POST['info_date_edit']) &&
        isset($_POST['info_country_edit']) &&
        isset($_POST['info_dir_edit']) &&
        isset($_POST['info_ppr_edit']) &&
        isset($_POST['info_who_edit']) &&
        isset($_POST['tmc_edit']) &&
        isset($_POST['quant_select_edit']) &&
        isset($_POST['quant_edit']) &&
        isset($_POST['price_select_edit']) &&
        isset($_POST['price_edit']) &&
        isset($_POST['fab_edit_text'])){
            $id_edit = $_POST['id_edit'];
            $name_edit = sanitize_str($_POST['name_edit']);
            $sur_edit = sanitize_str($_POST['sur_edit']);
            $name_lat_edit = sanitize_str($_POST['name_lat_edit']);
            $sur_lat_edit = sanitize_str($_POST['sur_lat_edit']);
            $birth_edit = sanitize_date($_POST['birth_edit']);
            $civil_edit = sanitize_str($_POST['civil_edit']);
            $pass_edit = sanitize_str($_POST['pass_edit']);
            $number_edit = sanitize_str($_POST['number_edit']);
            $number_auto_edit = sanitize_str($_POST['number_auto_edit']);
            $info_date_edit = sanitize_date($_POST['info_date_edit']);
            $info_country_edit = sanitize_str($_POST['info_country_edit']);
            $info_dir_edit = sanitize_str($_POST['info_dir_edit']);
            $info_ppr_edit = sanitize_str($_POST['info_ppr_edit']);
            $info_who_edit = sanitize_str($_POST['info_who_edit']);
            $tmc_edit = sanitize_str($_POST['tmc_edit']);
            $quant_select_edit = sanitize_str($_POST['quant_select_edit']);
            $quant_edit = sanitize_int($_POST['quant_edit']);
            $price_select_edit = sanitize_str($_POST['price_select_edit']);
            $price_edit = sanitize_int($_POST['price_edit']);
            $fab_edit_text = sanitize_str($_POST['fab_edit_text']);
            
            require "../libs/db_conn.lib.php";
            
            //update таблицы persons
            $name_edit = $db_conn->real_escape_string($name_edit);
            $sur_edit = $db_conn->real_escape_string($sur_edit);
            $name_lat_edit = $db_conn->real_escape_string($name_lat_edit);
            $sur_lat_edit = $db_conn->real_escape_string($sur_lat_edit);
            $birth_edit = $db_conn->real_escape_string($birth_edit);
            $civil_edit = $db_conn->real_escape_string($civil_edit);
            $pass_edit = $db_conn->real_escape_string($pass_edit);
            $number_edit = $db_conn->real_escape_string($number_edit);
            $number_auto_edit = $db_conn->real_escape_string($number_auto_edit);
            
            $query_edit_persons = "UPDATE persons SET
                                    name = '$name_edit',
                                    sur = '$sur_edit',
                                    name_lat = '$name_lat_edit',
                                    sur_lat = '$sur_lat_edit',
                                    birth = '$birth_edit',
                                    civil = '$civil_edit',
                                    passport = '$pass_edit',
                                    number_pers = '$number_edit',
                                    number_auto = '$number_auto_edit'
                                    WHERE persons_id = '$id_edit'";
            $result_persons = $db_conn->query($query_edit_persons);
            
            //update таблицы info_fab
            $info_country_edit = $db_conn->real_escape_string($info_country_edit);
            $info_dir_edit = $db_conn->real_escape_string($info_dir_edit);
            $info_ppr_edit = $db_conn->real_escape_string($info_ppr_edit);
            $info_who_edit = $db_conn->real_escape_string($info_who_edit);
            $fab_edit_text = $db_conn->real_escape_string($fab_edit_text);
            
            $query_edit_info_fab = "UPDATE info_fab SET
                                    date_info = '$info_date_edit',
                                    country = '$info_country_edit',
                                    direction = '$info_dir_edit',
                                    ppr = '$info_ppr_edit',
                                    who = '$info_who_edit',
                                    fab = '$fab_edit_text'
                                    WHERE persons_id = '$id_edit'";
            $result_info_fab = $db_conn->query($query_edit_info_fab);
            
            //update таблицы tmc
            $tmc_edit = $db_conn->real_escape_string($tmc_edit);
            $quant_select_edit = $db_conn->real_escape_string($quant_select_edit);
            $quant_edit = $db_conn->real_escape_string($quant_edit);
            $price_select_edit = $db_conn->real_escape_string($price_select_edit);
            $price_edit = $db_conn->real_escape_string($price_edit);
            
            $query_edit_tmc = "UPDATE tmc SET
                                    sort = '$tmc_edit',
                                    quant_sel = '$quant_select_edit',
                                    quant = '$quant_edit',
                                    price_sel = '$price_select_edit',
                                    price = '$price_edit'
                                    WHERE persons_id = '$id_edit'";
            
            $result_tmc = $db_conn->query($query_edit_tmc);
            
			//вывод результата для пользователя
            if ($result_persons && $result_info_fab && $result_tmc) {
                echo "<fieldset id='edit_result'>";
                echo "ДАННЫЕ ДЛЯ ЛИЦА $sur_edit УСПЕШНО ОБНОВЛЕНЫ";
                echo "</fieldset";
            }
            $db_conn->close(); 
    }//endif isset group
}//endif isset($_POST['edit_person'])

?>
    
</div>


<?php
require_once "../footer.php";
?>

</body>
</html>