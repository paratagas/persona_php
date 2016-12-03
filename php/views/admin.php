<!DOCTYPE html>
<html>
<?php
/**
 * основной файл группы Admin
 * 
 * используется для операций с пользователями в таблице users
 * 
 * @author Евгений Свириденко <partagas@mail.ru>
 * @version Persona 1.0 дата релиза 18.11.2014
 * @copyright Е.Свириденко 2014
 */
 
header("Content-Type: text/html; charset=utf-8");

require_once "../header_int.php";
require "../libs/admin.lib.php";
?>

<div id="CONTENT">
	<h2>Панель администратора</h2>
      
      <fieldset id="admin_new_group">
      <form action="../libs/admin_action.php" method="POST">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr class="group_name">
              <td>Добавление пользователя</td>
            </tr>
            <tr>
              <td>Ввести логин</td>
              <td align="left">
                  <input type="text" name="admin_new_name" size="30" maxlength="30" required="required" />
              </td>
            </tr>
            <tr>
              <td>Ввести пароль</td>
              <td align="left">
                  <input type="password" name="admin_new_pass" size="30" maxlength="40" required="required" />
              </td>
            </tr>
            <tr>
              <td>Подтвердить пароль</td>
              <td align="left">
                  <input type="password" name="admin_new_conf_pass" size="30" maxlength="40" required="required" />
              </td>
            </tr> 
            <tr>
              <td>Ввести пароль администратора</td>
              <td align="left">
                  <input type="password" name="admin_admin_new_conf_pass" size="30" maxlength="40" required="required" />
              </td>
            </tr>
            <tr>
              <td align="left">
                  <input type="hidden" name="add_user" value="yes" />
                  <input type="submit" value="Добавить пользователя" />
              </td>
              <td align="left">
                  <input type="reset" value="Очистить форму" />
              </td>
            </tr>
          </table>
      </form>
      </fieldset>
      
      <br />
      
      <fieldset id="admin_chahge_pass_group">
      <form action="../libs/admin_action.php" method="POST">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr class="group_name">
              <td>Смена пароля</td>
            </tr>
            <tr>
              <td>Выбрать пользователя</td>
              <td align="left">
              <select name="admin_chahge_pass_select" id="admin_chahge_pass_select">
                <?php fill_users(); ?>
              </select>
              </td>
            </tr>
            <tr>
              <td>Ввести старый пароль</td>
              <td align="left">
                  <input type="password" name="chahge_pass_sel_user_old" size="30" maxlength="40" required="required" />
              </td>
            </tr>
            <tr>
              <td>Ввести новый пароль</td>
              <td align="left">
                  <input type="password" name="chahge_pass_sel_user_new" size="30" maxlength="40" required="required" />
              </td>
            </tr> 
            <tr>
              <td>Подтвердить новый пароль</td>
              <td align="left">
                  <input type="password" name="chahge_pass_sel_user_conf" size="30" maxlength="40" required="required" />
              </td>
            </tr>
            <tr>
              <td align="left">
                  <input type="hidden" name="change_pass" value="yes" />
                  <input type="submit" value="Сменить пароль" />
              </td>
              <td align="left">
                  <input type="reset" value="Очистить форму" />
              </td>
            </tr>
          </table>
      </form>
      </fieldset>
      
      <br />
      
      <fieldset id="admin_del_user_group">
      <form action="../libs/admin_action.php" method="POST">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr class="group_name">
              <td>Удаление пользователя</td>
            </tr>
            <tr>
              <td>Выбрать пользователя</td>
              <td align="left">
              <select name="admin_del_user_select" id="admin_del_user_select">
                  <?php fill_users(); ?>
              </select>
              </td>
            </tr>
            <tr>
              <td>Ввести пароль администратора</td>
              <td align="left">
                  <input type="password" name="admin_del_user_pass_text" size="30" maxlength="40" required="required" />
              </td>
            </tr>
            <tr>
              <td align="left">
                  <input type="hidden" name="del_user" value="yes" />
                  <input type="submit" value="Удалить пользователя" />
              </td>
              <td align="left">
                  <input type="reset" value="Очистить форму" />
              </td>
            </tr>
          </table>
      </form>
      </fieldset>
      
      <br />
      
      <fieldset id="admin_logs">
        <form action="../libs/admin_action.php" method="POST">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr class="group_name">
              <td>Вывод логов</td>
            </tr>
            <tr>
              <td>Ввести пароль администратора</td>
              <td align="left">
                  <input type="password" name="admin_pass_logs" size="30" maxlength="40" required="required" />
              </td>
            </tr>
            <tr>
              <td align="left">
                  <input type="hidden" name="show_logs" value="yes" />
                  <input type="submit" value="Показать логи" />
              </td>
              <td align="left">
                  <input type="reset" value="Очистить форму" />
              </td>
            </tr>
          </table>
      </form>
    </fieldset>
        
</div>

<?php
require_once "../footer.php";
?>

</body>
</html>
