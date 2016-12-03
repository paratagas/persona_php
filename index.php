<!DOCTYPE html>
<html>
<?php
/**
 * основной файл приложения и группы Index
 * 
 * @author Евгений Свириденко <partagas@mail.ru>
 * @version Persona 1.0 дата релиза 18.11.2014
 * @copyright Е.Свириденко 2014
 */
require_once "php/header.php";
?>

<div id="CONTENT">
	<h2>Вход в приложение</h2>
    <form action="php/libs/index_action.php" method="POST" enctype="multipart/form-data">
      
      <fieldset id="enter_group">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr class="group_name">
              <td>Ввести данные</td>
            </tr>
            <tr>
              <td>Введите логин</td>
              <td align="left">
                  <input type="text" name="enter_login" size="30" maxlength="40" required="required" />
              </td>
            </tr>
            <tr>
              <td>Введите пароль</td>
              <td align="left">
                  <input type="password" name="enter_pass" size="30" maxlength="40" required="required" />
              </td>
            </tr>
            
            <tr>
              <td align="left">
                  <input type="hidden" name="enter_app" value="yes" />
                  <input type="submit" value="Войти" />
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
require_once "php/footer.php";
?>
</body>
</html>
