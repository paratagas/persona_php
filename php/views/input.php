<!DOCTYPE html>
<html>
<?php
/**
 * основной файл группы Input
 * 
 * используется для внесения данных о лицах в БД
 * 
 * @author Евгений Свириденко <partagas@mail.ru>
 * @version Persona 1.0 дата релиза 18.11.2014
 * @copyright Е.Свириденко 2014
 */
 
header("Content-Type: text/html; charset=utf-8");

require_once "../header_int.php";
require_once "../libs/views.lib.php";

?>

<div id="CONTENT">
	<h2>Записать данные</h2>
    <form action="../libs/input_action.php" method="POST" enctype="multipart/form-data">
      
      <fieldset id="pers_input_group">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr class="group_name">
              <td>Личные данные</td>
            </tr>
            <tr>
              <td>Имя (рус.)</td>
              <td align="left">
                  <input type="text" name="name_input" size="30" maxlength="30" />
              </td>
            </tr>
            <tr>
              <td>Фамилия (рус.)</td>
              <td align="left">
                  <input type="text" name="sur_input" size="30" maxlength="30" required="required"/>
              </td>
            </tr>
            <tr>
              <td>Имя (лат.)</td>
              <td align="left">
                  <input type="text" name="name_lat_input" size="30" maxlength="30" />
              </td>
            </tr> 
            <tr>
              <td>Фамилия (лат.)</td>
              <td align="left">
                  <input type="text" name="sur_lat_input" size="30" maxlength="30" />
              </td>
            </tr>
            <tr>
              <td>Дата рождения</td>
              <td align="left">
                  <input id="birth_input_datepick" class="datepick_input" type="date" name="birth_input" />
              </td>
            </tr>
            <tr>
              <td>Гражданство</td>
              <td align="left">
              <select name="civil_input" id="civil_input_select">
                  <?php fill_select("countries.txt"); // Заполнение опций селекта из txt-файлов ?>
              </select>
              </td>
            </tr>
            <tr>
              <td>Номер паспорта</td>
              <td align="left">
                  <input type="text" name="pass_input" size="30" maxlength="30" />
              </td>
            </tr>
            <tr>
              <td>Личный номер</td>
              <td align="left">
                  <input type="text" name="number_input" size="30" maxlength="30" />
              </td>
            </tr>
            <tr>
              <td>Номер авто</td>
              <td align="left">
                  <input type="text" name="number_auto_input" size="30" maxlength="30" />
              </td>
            </tr>
          </table>
          
      </fieldset>
      
      <br />
      
      <fieldset id="info_input_group">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr class="group_name">
                <td>Информация о задержании</td>
            </tr>
            <tr>
              <td>Дата задержания</td>
              <td align="left">
                  <input id="info_date_input_datepick" class="datepick_input" type="date" name="info_date_input" />
              </td>
            </tr>
            <tr>
              <td>Сопредельное государство</td>
              <td align="left">
              <select name="info_country_input" id="info_country_input_select">
                  <?php fill_select("sop_gos.txt"); // Заполнение опций селекта из txt-файлов ?>
              </select>
              </td>
            </tr>
            <tr>
              <td>Направление</td>
              <td align="left">
                  <input type="radio" name="info_dir_input" value="Въезд">Въезд</input>
                  <input type="radio" name="info_dir_input" value="Выезд" checked="checked">Выезд</input>
              </td>
            </tr>
            <tr>
              <td>Пункт пропуска</td>
              <td align="left">
              <select name="info_ppr_input" id="info_ppr_input_select">
                  <?php fill_select("ppr.txt"); // Заполнение опций селекта из txt-файлов ?>
              </select>
              </td>
            </tr>
            <tr>
              <td>Ведомство</td>
              <td align="left">
                  <input type="text" name="info_who_input" size="30" maxlength="30" />
              </td>
            </tr>
          </table>
      
      </fieldset>
      
      <br />
      
      <fieldset id="tmc_input_group">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr class="group_name">
              <td>Информация о ТМЦ</td>
            </tr>
            <tr>
              <td>Вид ТМЦ</td>
              <td></td>
              <td align="left">
              <select name="sort_input" id="sort_input_select" >
                  <?php fill_select("tmc.txt"); // Заполнение опций селекта из txt-файлов ?>
              </select>
              </td>
            </tr>
            <tr>
              <td>Количество</td>
              <td align="left">
              <select name="quant_input_select" id="quant_input_select_select">
                  <?php fill_select("quant.txt"); // Заполнение опций селекта из txt-файлов ?>
              </select>
              </td>
              <td align="left">
                  <input type="number" name="quant_input" size="30" maxlength="30" value="0" />
              </td>
            </tr>
            <tr>
              <td>Стоимость</td>
              <td align="left">
              <select name="price_input_select" id="price_input_select_select">
                  <?php fill_select("price.txt"); // Заполнение опций селекта из txt-файлов ?>
              </select>
              </td>
              <td align="left">
                  <input type="number" name="price_input" size="30" maxlength="30" value="0" />
              </td>
            </tr>
          </table>
      </fieldset>
      
      <br />
      
      <fieldset id="fab_input_group">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr class="group_name">
                <td>Описание правонарушения</td>
            </tr>
            <tr>
              <td align="left">
                  <textarea name="fab_input_text" cols="65" rows="15" required="required"></textarea>
              </td>
            </tr>
          </table>
      </fieldset>
      
      <br />
      
      
      <fieldset class="buttons">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr>
              <td align="left">
                  <input type="submit" value="Записать данные" />
              </td>
              <td align="left">
                  <input type="reset" value="Очистить форму" />
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
