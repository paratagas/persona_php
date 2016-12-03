<?php
/**
 * библиотека функций для тестирования
 * 
 * @author Евгений Свириденко <partagas@mail.ru>
 * @version Persona 1.0 дата релиза 18.11.2014
 * @copyright Е.Свириденко 2014
 */
 
header("Content-Type: text/html; charset=utf-8");

/**
   * функция test_edit($msg)
   * 
   * используется для вывода в файл (в корне сайта) значений переменных
   * 
   * @param void $msg данные для проверки
*/
function test_edit($msg){
	define("OUTPUT_PATH", "../../");
    define("OUTPUT_FILE", "test.doc");
	$file_export = OUTPUT_PATH.OUTPUT_FILE;
    file_put_contents($file_export, $msg);
}

?>