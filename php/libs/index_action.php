<?php
/**
 * файл группы Index
 * 
 * используется для входа в приложение
 * 
 * @author Евгений Свириденко <partagas@mail.ru>
 * @version Persona 1.0 дата релиза 18.11.2014
 * @copyright Е.Свириденко 2014
 */
 
header("Content-Type: text/html; charset=utf-8");

require_once "index.lib.php";

//вход в приложение
if(isset($_POST['enter_app'])){
    if(!empty($_POST['enter_login']) &&
        !empty($_POST['enter_pass'])){
            $check_user = check_user($_POST['enter_login'], $_POST['enter_pass']);
            if($check_user < 10){
                if($check_user != 0){
                    header("Location: ../views/input.php");
                }else{
                    show_result("ВВЕДЕН НЕВЕРНЫЙ ПАРОЛЬ И (ИЛИ) ЛОГИН");
                }
            }else{
                show_result("ОШИБКА СОЕДИНЕНИЯ С БАЗОЙ ДАННЫХ"); 
            }  
    }else{
        show_result("ЗАПОЛНЕНА НЕ ВСЯ ФОРМА");
    }
}


//вывод результата и возврат к admin.php если вход был безуспешным
if(isset($_POST['return_to_index'])){
    header("Location: ../../index.php");
}
?>