<?php
/**
 * библиотека функций для соединения с БД
 * 
 * @author Евгений Свириденко <partagas@mail.ru>
 * @version Persona 1.0 дата релиза 18.11.2014
 * @copyright Е.Свириденко 2014
 */
 
header("Content-Type: text/html; charset=utf-8");

define("HOST", "localhost");
define("USER", "root");
define("PASS", "55555");
define("DB_NAME", "persona_php");

$db_conn = new mysqli(HOST, USER, PASS, DB_NAME);

if (mysqli_connect_errno()) {
    echo "<div id='CONTENT'><div id='TEXT'>ОШИБКА СОЕДИНЕНИЯ С БАЗОЙ ДАННЫХ</div></div>";
    exit();
}


//изменение набора символов на utf8 
$db_conn->set_charset("utf8");

?>
