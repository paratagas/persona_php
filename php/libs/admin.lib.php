<?php
/**
 * библиотека функций для страницы admin.php
 * 
 * @author Евгений Свириденко <partagas@mail.ru>
 * @version Persona 1.0 дата релиза 18.11.2014
 * @copyright Е.Свириденко 2014
 */

header("Content-Type: text/html; charset=utf-8");

require_once "sanitize.lib.php";

/**
   * функция fill_users()
   * 
   * используется для заполнения опций select пользователями из таблицы users
   * вызывается в admin.php
*/
function fill_users(){
	require "db_conn.lib.php";
    $query = "SELECT users_id, login FROM users 
                        WHERE users_id > 0
                        ORDER BY login";
    if ($result = $db_conn->query($query)) {
        $row_cnt = $result->num_rows;
        for($i=0; $i<$row_cnt; $i++){
            $rows = $result->fetch_assoc();
            $users_id = $rows['users_id'];
            $login = $rows['login'];
            echo "<option value='$users_id, $login'>$login</option>";
        }
    }else{
        $error_select = "Нет необходимых данных";
        echo "<option value='no_value'>$error_select</option>";
    }
    $db_conn->close();
}

/**
   * функция add_user($new_login, $new_pass)
   * 
   * используется для добавления нового пользователя в таблицу users
   * вызывается в admin_action.php
   * 
   * @param string $new_login логин пользователя
   * @param string $new_pass пароль пользователя
   * @return integer индикатор успешности операции
*/
function add_user($new_login, $new_pass){
    $new_login = sanitize_pass($new_login);
    $new_pass = sanitize_pass($new_pass);
    require "db_conn.lib.php";
    $new_login = $db_conn->real_escape_string($new_login);
    $new_pass = $db_conn->real_escape_string($new_pass);
    $new_pass = secure_pass($new_pass);
    $query = "INSERT INTO users (users_id, login, password, sys_date)
                VALUES (NULL, '$new_login', '$new_pass', NOW())";
    if($result = $db_conn->query($query)){
        $result_success = 1;
    }else{
        $result_success = 0;
    }
    $db_conn->close();
    return $result_success;
}

/**
   * функция change_pass($change_login, $pass_old, $pass_new)
   * 
   * используется для смены пароля пользователя в таблице users
   * вызывается в admin_action.php
   * 
   * @param string $change_login логин пользователя
   * @param string $pass_old старый пароль пользователя
   * @param string $pass_new новый пароль пользователя
   * @return integer индикатор успешности операции
   * @uses sanitize_pass() sanitize.lib.php
   * @uses secure_pass() sanitize.lib.php
*/
function change_pass($change_login, $pass_old, $pass_new){
	$id_part = strtok($change_login, ",");
    $login_part = trim(strtok(","));
    $id_part = sanitize_pass($id_part);
    $login_part = sanitize_pass($login_part);
    $pass_old = sanitize_pass($pass_old);
    $pass_new = sanitize_pass($pass_new);
    require "db_conn.lib.php";
    $id_part = $db_conn->real_escape_string($id_part);
    $login_part = $db_conn->real_escape_string($login_part);
    $pass_old = $db_conn->real_escape_string($pass_old);
    $pass_new = $db_conn->real_escape_string($pass_new);
    $pass_old = secure_pass($pass_old);
    $pass_new = secure_pass($pass_new);
    $query_search = "SELECT login FROM users
                        WHERE users_id = '$id_part'
                        AND login = '$login_part'
                        AND password = '$pass_old'";
    if($result = $db_conn->query($query_search)){
        $row_cnt = $result->num_rows;
        if($row_cnt > 0){
            $query_update = "UPDATE users SET
                            password = '$pass_new'
                            WHERE users_id = '$id_part'
                            AND login = '$login_part'";
            if($result = $db_conn->query($query_update)){
                $result_success = 1;
            }else{
                $result_success = 0;
            }
        }else{
            $result_success = 0;
        }
    }else{
        $result_success = 0;
    }
    $db_conn->close();
    return $result_success;
} // end change_pass()

/**
   * функция del_user($del_user_select)
   * 
   * используется для удаления пользователя из таблицы users
   * вызывается в admin_action.php
   * 
   * @param string $del_user_select логин пользователя
   * @return integer индикатор успешности операции
   * @uses sanitize_pass() sanitize.lib.php
*/
function del_user($del_user_select){
    $id_part = strtok($del_user_select, ",");
    $login_part = trim(strtok(","));
    $id_part = sanitize_pass($id_part);
    $login_part = sanitize_pass($login_part);
    require "db_conn.lib.php";
    $id_part = $db_conn->real_escape_string($id_part);
    $login_part = $db_conn->real_escape_string($login_part);
    $query = "DELETE FROM users 
                WHERE users_id = '$id_part'
                AND login = '$login_part'";
    if($result = $db_conn->query($query)){
        $result_success = 1;
    }else{
        $result_success = 0;
    }
    $db_conn->close();
    return $result_success;
}

/**
   * функция check_admin($pass_admin)
   * 
   * используется для проверки пароля админа
   * вызывается в admin_action.php
   * 
   * @param string $pass_admin пароль админа
   * @return integer индикатор успешности операции
   * @uses sanitize_pass() sanitize.lib.php
*/
function check_admin($pass_admin){
    $pass_admin = sanitize_pass($pass_admin);
	require "db_conn.lib.php";
    $pass_admin = $db_conn->real_escape_string($pass_admin);
    $pass_admin = secure_pass($pass_admin);
    $query = "SELECT login FROM users 
                        WHERE login = 'admin'
                        AND password = '$pass_admin'";
    if($result = $db_conn->query($query)){
        $row_cnt = $result->num_rows;
    }
    $result_success = intval($row_cnt);
    $db_conn->close();
    return $result_success;
}

/**
   * функция check_login($new_login)
   * 
   * используется для проверки существования вводимого логина
   * вызывается в admin_action.php с функцией add_user()
   * 
   * @param string $new_login новый логин
   * @return integer индикатор успешности операции
   * @uses sanitize_pass() sanitize.lib.php
*/
function check_login($new_login){
    $new_login = sanitize_pass($new_login);
	require "db_conn.lib.php";
    $new_login = $db_conn->real_escape_string($new_login);
    $query = "SELECT login FROM users 
                WHERE login = '$new_login'";
    if($result = $db_conn->query($query)){
        $row_cnt = $result->num_rows;
    }
    $result_success = intval($row_cnt);
    $db_conn->close();
    return $result_success;
}

/**
   * функция show_result($result)
   * 
   * используется для возврата на страницу admin.php и уведомления об успешности операции
   * вызывается в admin_action.php
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
	           <fieldset id="admin_result">
                    <form action="admin_action.php" method="POST">
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
                                <input type="hidden" name="return_to_admin" value="yes" />
                                <input type="submit" value="Вернуться на страницу администратора" />
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


/**
   * функция function show_logs()
   * 
   * используется для получения из БД логов из таблицы logs
   * вызывается в admin_action.php
*/
function show_logs(){
    require "db_conn.lib.php";
    $query = "SELECT logs_id, login, event, sys_date
                FROM logs 
                WHERE logs_id > 0";
    if($result = $db_conn->query($query)){
        $row_cnt = $result->num_rows;
        echo <<<_END_1
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
                        <fieldset id="output_logs_header">
                        <form action="admin_action.php" method="POST">
                          <table border="0" cellspacing="10" cellpadding="0">
                            <tr class="group_name">
                              <td>ПОЛУЧЕННЫЕ ДАННЫЕ:</td>
                            </tr>
                            <tr></tr>
                            <tr>
                              <th align="left">ID записи</th>
                              <th align="left">Логин пользователя</th>
                              <th align="left">Совершенное действие</th>
                              <th align="left">Дата и время</th>
                            </tr>
_END_1;
        for($i=0; $i<$row_cnt; $i++){
            $rows = $result->fetch_assoc();
            
            $logs_id = $rows['logs_id'];
            $login = $rows['login'];
            $event = $rows['event'];
            $date_time = $rows['sys_date'];
            $date_time = date_create_from_format('Y-m-d H:i:s', $date_time);
            $date_time = date_format($date_time, 'd.m.Y H:i:s');
            echo <<<_END_2
                        <tr>
                            <td align="left">
                                $logs_id
                            </td>
                            <td align="left">
                                $login
                            </td>
                            <td align="left">
                                $event
                            </td>
                            <td align="left">
                                $date_time
                            </td>
                        </tr>
_END_2;
        }// end for
echo <<<_END_3
                        <tr>
                            <td align="left">
                                <input type="hidden" name="return_to_admin" value="yes" />
                                <input type="submit" value="Вернуться на страницу администратора" />
                            </td>
                        </tr>
                    </table>
                </form>
            </fieldset>
        </div>
    </body>
</html>
_END_3;
    } // endif $result = $db_conn->query($query)
}// end show_logs()

?> 