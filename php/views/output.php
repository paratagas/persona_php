<!DOCTYPE html>
<html>
<?php
/**
 * основной файл группы Output
 * 
 * используется для поиска данных о лицах в БД
 * 
 * @author Евгений Свириденко <partagas@mail.ru>
 * @version Persona 1.0 дата релиза 18.11.2014
 * @copyright Е.Свириденко 2014
 */
 
header("Content-Type: text/html; charset=utf-8");

require_once "../header_int.php";
require_once "../libs/views.lib.php"; // Библиотека функций для файлов группы views
require_once "../libs/sanitize.lib.php";

?>

<div id="CONTENT">
	<h2>Найти данные</h2>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
      
      <fieldset id="sur_output_group">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr class="group_name">
              <td>Искать по фамилии</td>
            </tr>
            <tr>
              <td>Фамилия (рус.)</td>
              <td align="left">
                  <input type="text" name="sur_output" size="30" maxlength="30" />
              </td>
            </tr>
            <tr>
              <td>Фамилия (лат.)</td>
              <td align="left">
                  <input type="text" name="sur_lat_output" size="30" maxlength="30" />
              </td>
            </tr>
            
            <tr>
              <td align="left">
                  <input type="submit" value="Найти" />
              </td>
              <td align="left">
                  <input type="reset" value="Очистить форму" />
              </td>
            </tr>
          </table>
      </fieldset>
   
    </form>
      <br />
    
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
      <fieldset id="num_output_group">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr class="group_name">
              <td>Искать по номеру паспорта или т/с</td>
            </tr>
            <tr>
              <td>Номер паспорта</td>
              <td align="left">
                  <input type="text" name="num_pass_output" size="30" maxlength="30" />
              </td>
            </tr>
            <tr>
              <td>Номер авто</td>
              <td align="left">
                  <input type="text" name="num_auto_output" size="30" maxlength="30" />
              </td>
            </tr>
            
            <tr>
              <td align="left">
                  <input type="submit" value="Найти" />
              </td>
              <td align="left">
                  <input type="reset" value="Очистить форму" />
              </td>
            </tr>
          </table>
      </fieldset>
    
    </form>
    
      <br />
    
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
      <fieldset id="info_output_group">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr class="group_name">
                <td>Искать по информации о задержании</td>
            </tr>
            <tr>
              <td>Дата задержания (с)</td>
              <td align="left">
                  <input id="info_date_output_datepick_from" class="datepick_input" type="date" name="info_date_output_datepick_from" />
              </td>
            </tr>
            <tr>
              <td>Дата задержания (по)</td>
              <td align="left">
                  <input id="info_date_output_datepick_to" class="datepick_input" type="date" name="info_date_output_datepick_to" />
              </td>
            </tr>
            <tr>
              <td>Пункт пропуска</td>
              <td align="left">
              <select name="info_ppr_output_select" id="info_ppr_output_select">
                  <?php fill_select("ppr.txt"); // Заполнение опций селекта из txt-файлов ?>
              </select>
              </td>
            </tr>
            <tr>
              <td>Направление</td>
              <td align="left">
                  <input type="radio" name="info_dir_output" value="Въезд">Въезд</input>
                  <input type="radio" name="info_dir_output" value="Выезд" checked="checked">Выезд</input>
              </td>
            </tr>
            
            <tr>
              <td align="left">
                  <input type="submit" value="Найти" />
              </td>
              <td align="left">
                  <input type="reset" value="Очистить форму" />
              </td>
            </tr>
            
          </table>
      
      </fieldset>
    
    </form>
    
      <br />
    
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
      <fieldset id="info_date_output_group">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr class="group_name">
                <td>Искать только по дате задержания</td>
            </tr>
            <tr>
              <td>Дата задержания (с)</td>
              <td align="left">
                  <input id="info_date_self_output_datepick_from" class="datepick_input" type="date" name="info_date_self_output_datepick_from" />
              </td>
            </tr>
            <tr>
              <td>Дата задержания (по)</td>
              <td align="left">
                  <input id="info_date_self_output_datepick_to" class="datepick_input" type="date" name="info_date_self_output_datepick_to" />
              </td>
            </tr>
            
            
            <tr>
              <td align="left">
                  <input type="submit" value="Найти" />
              </td>
              <td align="left">
                  <input type="reset" value="Очистить форму" />
              </td>
            </tr>
            
          </table>
      
      </fieldset>
    </form>
    
      <br />
    
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
      <fieldset id="info_keywords_group">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr class="group_name">
                <td>Искать по ключевым словам</td>
            </tr>
            
            <tr>
              <td>Введите ключевые слова, разделенные пробелами</td>
              <td align="left">
                  <input type="text" name="info_keywords" size="60" maxlength="60" required="required" />
              </td>
            </tr>
            
            <tr>
              <td align="left">
                  <input type="submit" value="Найти" />
              </td>
              <td align="left">
                  <input type="reset" value="Очистить форму" />
              </td>
            </tr>
            
          </table>
      
      </fieldset>
    </form>
      <br />
      
      
<?php

/**
   * функция function search_person($query)
   * 
   * используется для поиска лиц и вывода информации
   * вызывается в output.php
   * 
   * @param string $query строка запроса
*/
function search_person($query){
    require "../libs/db_conn.lib.php";
    
    $action = $_SERVER['PHP_SELF'];
    
    $file_export = "../../txt/buffer.txt";
    $data_clear = "";
    file_put_contents($file_export, $data_clear);
    
    $row_cnt = 0;
    if ($result = $db_conn->query($query)) {
    
        /* определение числа рядов в выборке */
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
            $name_lat = $rows['name_lat'];
            $sur_lat = $rows['sur_lat'];
            
            $birth = $rows['birth'];
            $birth = date_create_from_format('Y-m-d', $birth);
            $birth = date_format($birth, 'd.m.Y');
            
            $civil = $rows['civil'];
            $passport = $rows['passport'];
            $number_pers = $rows['number_pers'];
            $number_auto = $rows['number_auto'];
            
            $date_info = $rows['date_info'];
            $date_info = date_create_from_format('Y-m-d', $date_info);
            $date_info = date_format($date_info, 'd.m.Y');
            
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
            
            $data = <<<_END_2
            <table border="0" cellspacing="10" cellpadding="0">
                <tr class="group_name">
                  <td></td>
                </tr>
                <tr class="group_name">
                  <td>Персона № $cnt:</td>
                </tr>
                
                <tr>
                <td>Имя (рус.):</td>
                <td align="left">
                    $name
                </td>
                </tr>
                
                <tr>
                <td>Фамилия (рус.):</td>
                <td align="left">
                    $sur
                </td>
                </tr>
                
                <tr>
                <td>Имя (лат.):</td>
                <td align="left">
                    $name_lat
                </td>
                </tr>
                
                <tr>
                <td>Фамилия (лат):</td>
                <td align="left">
                    $sur_lat
                </td>
                </tr>
                
                <tr>
                <td>Дата рождения:</td>
                <td align="left">
                    $birth
                </td>
                </tr>
                
                <tr>
                <td>Гражданство:</td>
                <td align="left">
                    $civil
                </td>
                </tr>
                
                <tr>
                <td>Номер паспорта:</td>
                <td align="left">
                    $passport
                </td>
                </tr>
                
                <tr>
                <td>Личный номер:</td>
                <td align="left">
                    $number_pers
                </td>
                </tr>
                
                <tr>
                <td>Номер автомобиля:</td>
                <td align="left">
                    $number_auto
                </td>
                </tr>
                
                <tr>
                <td>Дата задержания:</td>
                <td align="left">
                    $date_info
                </td>
                </tr>
                
                <tr>
                <td>Сопредельное государство:</td>
                <td align="left">
                    $country
                </td>
                </tr>
                
                <tr>
                <td>Направление:</td>
                <td align="left">
                    $direction
                </td>
                </tr>
                
                <tr>
                <td>Пункт пропуска:</td>
                <td align="left">
                    $ppr
                </td>
                </tr>
                
                <tr>
                <td>Задержан сотрудниками:</td>
                <td align="left">
                    $who
                </td>
                </tr>
                
                <tr>
                <td>Предмет АТП:</td>
                <td align="left">
                    $sort
                </td>
                </tr>
                
                <tr>
                <td>В количестве:</td>
                <td align="left">
                    $quant $quant_sel
                </td>
                </tr>
                
                <tr>
                <td>Стоимостью:</td>
                <td align="left">
                    $price $price_sel
                </td>
                </tr>
                
                <tr>
                <td>Обстоятельства задержания:</td>
                <td align="left">
                    $fab
                </td>
                </tr>
                
            </table>
_END_2;
            
            echo $data;    
            $cnt++;
            //echo $id; // для проверки $id
            
            // промежуточный экспорт для последующего экспорта в Word
            file_put_contents($file_export, $data, FILE_APPEND);
            
        }// end for
        
        echo "</div>";
        echo "</fieldset>";
    } // endif
    
    echo <<<_END_3
            <fieldset class='result_output'>
                <table border="0" cellspacing="10" cellpadding="0">
                    <tr class="group_name">
                        <td align="left">
                            <form action="$action" method="POST">
                                <input type="submit" value="Экспорт в Word" />
                                <input type="hidden" name="export_word" value="yes" />
                            </form>
                        </td>
                    </tr>
                </table>
            </fieldset>
_END_3;
    $db_conn->close(); 
} // end search_person()


// Поиск по фамилии
if(isset($_POST['sur_output']) && isset($_POST['sur_lat_output'])){
    if(!empty($_POST['sur_output']) && !empty($_POST['sur_lat_output'])){
        //функция выборки из файла output_action.php
        require "../libs/db_conn.lib.php";
        
        $sur_output = sanitize_str($_POST['sur_output']);
        $sur_lat_output = sanitize_str($_POST['sur_lat_output']);
        $sur_output = $db_conn->real_escape_string($sur_output);
        $sur_lat_output = $db_conn->real_escape_string($sur_lat_output);
        
        $db_conn->close();
        
        $query_search = "SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE p.sur LIKE '%$sur_output%' AND p.sur_lat LIKE '%$sur_lat_output%'
			ORDER BY p.sur";

        search_person($query_search);
    }elseif(!empty($_POST['sur_output']) && empty($_POST['sur_lat_output'])){
        //функция выборки из файла output_action.php
        require "../libs/db_conn.lib.php";
        $sur_output = sanitize_str($_POST['sur_output']);
        $sur_output = $db_conn->real_escape_string($sur_output);
        $db_conn->close();
        $query_search = "SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE p.sur LIKE '%$sur_output%'
			ORDER BY p.sur";
            
        search_person($query_search);
    }elseif(empty($_POST['sur_output']) && !empty($_POST['sur_lat_output'])){
        //функция выборки из файла output_action.php
        require "../libs/db_conn.lib.php";
        
        $sur_lat_output = sanitize_str($_POST['sur_lat_output']);
        $sur_lat_output = $db_conn->real_escape_string($sur_lat_output);
        $db_conn->close();
        
        $query_search = "SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE p.sur_lat LIKE '%$sur_lat_output%'
			ORDER BY p.sur";
        search_person($query_search);
    }else{
        
    }
}


// Поиск по номеру паспорта или т/с
if(isset($_POST['num_pass_output']) && isset($_POST['num_auto_output'])){
    if(!empty($_POST['num_pass_output']) && !empty($_POST['num_auto_output'])){
        //функция выборки из файла output_action.php
        require "../libs/db_conn.lib.php";
        
        $passport = sanitize_str($_POST['num_pass_output']);
        $number_auto = sanitize_str($_POST['num_auto_output']);
        $passport = $db_conn->real_escape_string($passport);
        $number_auto = $db_conn->real_escape_string($number_auto);
        
        $db_conn->close();
        
        $query_search = "SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE p.passport='$passport' AND p.number_auto='$number_auto'
			ORDER BY p.sur";

        search_person($query_search);
    }elseif(!empty($_POST['num_pass_output']) && empty($_POST['num_auto_output'])){
        //функция выборки из файла output_action.php
        require "../libs/db_conn.lib.php";
        $passport = sanitize_str($_POST['num_pass_output']);
        $passport = $db_conn->real_escape_string($passport);
        $db_conn->close();
        $query_search = "SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE p.passport='$passport'
			ORDER BY p.sur";
            
        search_person($query_search);
    }elseif(empty($_POST['num_pass_output']) && !empty($_POST['num_auto_output'])){
        //функция выборки из файла output_action.php
        require "../libs/db_conn.lib.php";
        
        $number_auto = sanitize_str($_POST['num_auto_output']);
        $number_auto = $db_conn->real_escape_string($number_auto);
        $db_conn->close();
        
        $query_search = "SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE p.number_auto='$number_auto'
			ORDER BY p.sur";
        search_person($query_search);
    }else{
        
    }
}

    
// Поиск по информации о задержании
if(isset($_POST['info_date_output_datepick_from']) && isset($_POST['info_date_output_datepick_to'])
    && isset($_POST['info_ppr_output_select']) && isset($_POST['info_dir_output'])){
    if(!empty($_POST['info_date_output_datepick_from']) && !empty($_POST['info_date_output_datepick_to'])){
        //функция выборки из файла output_action.php
        require "../libs/db_conn.lib.php";
        
        $date_output_from = $_POST['info_date_output_datepick_from'];
        $date_output_to = $_POST['info_date_output_datepick_to'];
        $ppr_output = $_POST['info_ppr_output_select'];
        $ppr_output = rtrim($ppr_output);
        $dir_output = $_POST['info_dir_output'];
        
        $date_output_from = $db_conn->real_escape_string($date_output_from);
        $date_output_to = $db_conn->real_escape_string($date_output_to);
        $ppr_output = $db_conn->real_escape_string($ppr_output);
        $dir_output = $db_conn->real_escape_string($dir_output);

        $db_conn->close();
            
        $query_search = "SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE i.ppr = '$ppr_output' AND i.direction = '$dir_output'
            AND i.date_info BETWEEN '$date_output_from' AND '$date_output_to'
			ORDER BY i.date_info";

        search_person($query_search);
    }elseif(!empty($_POST['info_date_output_datepick_from']) && empty($_POST['info_date_output_datepick_to'])){
        //функция выборки из файла output_action.php
        require "../libs/db_conn.lib.php";
        
        $date_output_from = $_POST['info_date_output_datepick_from'];
        
        $ppr_output = $_POST['info_ppr_output_select'];
        $ppr_output = rtrim($ppr_output);
        $dir_output = $_POST['info_dir_output'];
        
        $date_output_from = $db_conn->real_escape_string($date_output_from);
        $ppr_output = $db_conn->real_escape_string($ppr_output);
        $dir_output = $db_conn->real_escape_string($dir_output);
        
        $db_conn->close();
        
        $query_search = "SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
            WHERE i.ppr = '$ppr_output' AND i.direction = '$dir_output'
            AND i.date_info >= '$date_output_from'
			ORDER BY i.date_info";
            
        search_person($query_search);
    }elseif(empty($_POST['info_date_output_datepick_from']) && !empty($_POST['info_date_output_datepick_to'])){
        //функция выборки из файла output_action.php
        require "../libs/db_conn.lib.php";
        
        
        $date_output_to = $_POST['info_date_output_datepick_to'];
        $ppr_output = $_POST['info_ppr_output_select'];
        $ppr_output = rtrim($ppr_output);
        $dir_output = $_POST['info_dir_output'];
        
        $date_output_to = $db_conn->real_escape_string($date_output_to);
        $ppr_output = $db_conn->real_escape_string($ppr_output);
        $dir_output = $db_conn->real_escape_string($dir_output);
   
        $db_conn->close();
        
        $query_search = "SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE i.ppr = '$ppr_output' AND i.direction = '$dir_output'
            AND i.date_info <= '$date_output_to'
			ORDER BY i.date_info";
            
        search_person($query_search);
    }else{
        
    }
}
    
// Поиск только по дате задержания
if(isset($_POST['info_date_self_output_datepick_from']) && isset($_POST['info_date_self_output_datepick_to'])){
    if(!empty($_POST['info_date_self_output_datepick_from']) && !empty($_POST['info_date_self_output_datepick_to'])){
        //функция выборки из файла output_action.php
        require "../libs/db_conn.lib.php";
        
        $date_self_from = $_POST['info_date_self_output_datepick_from'];
        $date_self_to = $_POST['info_date_self_output_datepick_to'];
        //$date_self_from = sanitize_date($_POST['info_date_self_output_datepick_from']);
        //$date_self_to = sanitize_date($_POST['info_date_self_output_datepick_to']);
        $date_self_from = $db_conn->real_escape_string($date_self_from);
        $date_self_to = $db_conn->real_escape_string($date_self_to);
        
        $db_conn->close();
        
        $query_search = "SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE i.date_info BETWEEN '$date_self_from' AND '$date_self_to'
			ORDER BY i.date_info";

        search_person($query_search);
    }elseif(!empty($_POST['info_date_self_output_datepick_from']) && empty($_POST['info_date_self_output_datepick_to'])){
        //функция выборки из файла output_action.php
        require "../libs/db_conn.lib.php";
        $date_self_from = $_POST['info_date_self_output_datepick_from'];
        //$date_self_from = sanitize_date($_POST['info_date_self_output_datepick_from']);
        $date_self_from = $db_conn->real_escape_string($date_self_from);
        $db_conn->close();
        $query_search = "SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE i.date_info >= '$date_self_from'
			ORDER BY i.date_info";
            
        search_person($query_search);
    }elseif(empty($_POST['info_date_self_output_datepick_from']) && !empty($_POST['info_date_self_output_datepick_to'])){
        //функция выборки из файла output_action.php
        require "../libs/db_conn.lib.php";
        
        $date_self_to = $_POST['info_date_self_output_datepick_to'];
        //$date_self_to = sanitize_date($_POST['info_date_self_output_datepick_to']);
        $date_self_to = $db_conn->real_escape_string($date_self_to);
        $db_conn->close();
        
        $query_search = "SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE i.date_info <= '$date_self_to'
			ORDER BY i.date_info";
        search_person($query_search);
    }else{
        
    }
}
    
// Поиск по ключевым словам
if(isset($_POST['info_keywords']) && !empty($_POST['info_keywords'])){
    //$res_keywords = "";
    require "../libs/db_conn.lib.php";
    $info_keywords = sanitize_str($_POST['info_keywords']);
    $info_keywords = $db_conn->real_escape_string($info_keywords);
    $db_conn->close();
    //TODO: обработка массива $info_keywords
    //функция выборки из файла output_action.php
    $query_search = "SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE MATCH (i.fab) AGAINST ('$info_keywords')
			ORDER BY p.sur";
    //$res_keywords = "ЗАПРОС УСПЕШНО ВЫПОЛНЕН";
    search_person($query_search);
}


// Проверка условия для поиска всех персон
if(isset($_POST['search_all'])){
    //функция поиска всех персон из файла output_action.php (см. ниже)
    search_all();
}

// Проверка условия для удаления результатов поиска
if(isset($_POST['clear_all'])){
    //функция удаления результатов поиска
    clear_all();
}

// Проверка условия для экспорта в MS Word
if(isset($_POST['export_word'])){
    define("BUFFER_PATH", "../../txt/");
    define("BUFFER_FILE", "buffer.txt");
    if(file_exists(BUFFER_PATH.BUFFER_FILE)){
        $buffer_content = file_get_contents(BUFFER_PATH.BUFFER_FILE);
    }
    //функция экспорта в MS Word результатов поиска
    export_word($buffer_content);
}

/**
   * функция search_all()
   * 
   * используется для поиска всех персон
   * вызывается в output.php
*/
function search_all(){
	$query_search = "SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE p.persons_id > 0
			ORDER BY p.sur";
    search_person($query_search);
}


/**
   * функция clear_all()
   * 
   * используется для удаления результатов поиска
   * вызывается в output.php
*/
function clear_all(){
	header('Location: ' . $_SERVER['PHP_SELF']);
}


/**
   * функция export_word($export_data)
   * 
   * используется для экспорта в MS Word результатов поиска из файла buffer.txt в файл persona_php.doc
   * вызывается в admin_action.php
   * 
   * @param string $export_data выборка по лицам
*/
function export_word($export_data){
    define("OUTPUT_PATH", "../../");
    define("OUTPUT_FILE", "persona_php.doc");
	$file_export = OUTPUT_PATH.OUTPUT_FILE;
    file_put_contents($file_export, $export_data);
}

?>
      
      <fieldset id="output_data_group_3">
            <table border="0" cellspacing="10" cellpadding="0">
            <tr>
              <td align="left">
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                  <input type="submit" value="Найти всех" />
                  <input type="hidden" name="search_all" value="yes" />
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
    
    

 
</div> <!--end CONTENT -->

<?php
require_once "../footer.php";
?>

</body>
</html>