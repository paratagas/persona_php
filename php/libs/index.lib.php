<?php 
/**
 * библиотека функций для страницы index.php
 * 
 * @author Евгений Свириденко <partagas@mail.ru>
 * @version Persona 1.0 дата релиза 18.11.2014
 * @copyright Е.Свириденко 2014
 */
 
header("Content-Type: text/html; charset=utf-8");

require_once "sanitize.lib.php";

/**
   * функция check_user($enter_login, $enter_pass)
   * 
   * используется для входа в приложение
   * вызывается в index_action.php
   * 
   * @param string $enter_login логин пользователя
   * @param string $enter_pass пароль пользователя
   * @return integer индикатор успешности операции
   * @uses sanitize_pass() sanitize.lib.php
   * @uses secure_pass() sanitize.lib.php
*/
function check_user($enter_login, $enter_pass){
    $enter_login = sanitize_pass($enter_login);
    $enter_pass = sanitize_pass($enter_pass);
	require "db_conn.lib.php";
    $enter_login = $db_conn->real_escape_string($enter_login);
    $enter_pass = $db_conn->real_escape_string($enter_pass);
    $enter_pass = secure_pass($enter_pass);
    $query = "SELECT login FROM users 
                        WHERE login = '$enter_login'
                        AND password = '$enter_pass'";
    if($result = $db_conn->query($query)){
        $row_cnt = $result->num_rows;
        $result_success = intval($row_cnt);
    }else{
        $result_success = 10;
    }
    $db_conn->close();
    return $result_success;
}

/**
   * функция show_result($result)
   * 
   * используется для возврата на страницу admin.php и уведомления об успешности операции
   * вызывается в index_action.php
   * 
   * @param string $result сообщение для пользователя
*/
function show_result($result){
    echo <<<_END
    <!DOCTYPE html>
    <html>
        <head>
            <title>Персона 1.0</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            </title>
            <link href="../../css/styles.css" rel="stylesheet" type="text/css">
        </head>
        <body>
            <br />
            <div id="CONTENT">
	           <fieldset id="enter_result">
                    <form action="index_action.php" method="POST">
                    <table border="0" cellspacing="10" cellpadding="0">
                        <tr class="group_name">
                            <td>Результат операции:</td>
                        </tr>
                        <tr>
                            <td align="left">
                                $result
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                <input type="hidden" name="return_to_index" value="yes" />
                                <input type="submit" value="Вернуться на страницу входа" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </fieldset>
            </div>
        </body>
    </html>
_END;
}

?> 