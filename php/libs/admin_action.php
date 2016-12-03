<?php
/**
 * файл группы Admin
 * 
 * используется для добавления и удаления пользователей в БД, а также смены паролей
 * 
 * @author Евгений Свириденко <partagas@mail.ru>
 * @version Persona 1.0 дата релиза 18.11.2014
 * @copyright Е.Свириденко 2014
 */
 
header("Content-Type: text/html; charset=utf-8");

require_once "admin.lib.php";

//Добавление пользователя
if(isset($_POST['add_user'])){
    if(!empty($_POST['admin_new_name']) &&
        !empty($_POST['admin_new_pass']) &&
        !empty($_POST['admin_new_conf_pass']) &&
        !empty($_POST['admin_admin_new_conf_pass']) &&
        $_POST['admin_new_pass'] == $_POST['admin_new_conf_pass']){
            $check_admin = check_admin($_POST['admin_admin_new_conf_pass']);
            if($check_admin){
                $new_login = $_POST['admin_new_name'];
                $new_pass = $_POST['admin_new_pass'];
                $check_login = check_login($new_login);
                if(!$check_login){
                    $check_add = add_user($new_login, $new_pass);
                    if($check_add){
                        show_result("ПОЛЬЗОВАТЕЛЬ УСПЕШНО ДОБАВЛЕН");
                    }else{
                        show_result("ОШИБКА: ПОЛЬЗОВАТЕЛЬ НЕ ДОБАВЛЕН"); 
                    }
                }else{
                    show_result("ТАКОЙ ЛОГИН УЖЕ СУЩЕСТВУЕТ. ПОПРОБУЙТЕ ВЫБРАТЬ ДРУГОЙ"); 
                }
            }else{
                show_result("НЕВЕРНЫЙ ПАРОЛЬ АДМИНИСТРАТОРА");
            }
    }else{
        show_result("ЗАПОЛНЕНА НЕ ВСЯ ФОРМА ИЛИ ПАРОЛЬ И ЕГО ПОДТВЕРЖДЕНИЕ НЕ СОВПАДАЮТ");
    }
} //end isset($_POST['add_user'])

//Смена пароля
if(isset($_POST['change_pass'])){
    if(!empty($_POST['admin_chahge_pass_select']) &&
        !empty($_POST['chahge_pass_sel_user_old']) &&
        !empty($_POST['chahge_pass_sel_user_new']) &&
        !empty($_POST['chahge_pass_sel_user_conf']) &&
        $_POST['chahge_pass_sel_user_new'] == $_POST['chahge_pass_sel_user_conf']){
            $change_login = $_POST['admin_chahge_pass_select'];
            $pass_old = $_POST['chahge_pass_sel_user_old'];
            $pass_new = $_POST['chahge_pass_sel_user_new'];
            $check_change_pass = change_pass($change_login, $pass_old, $pass_new);
            if($check_change_pass){
                show_result("ПАРОЛЬ УСПЕШНО ИЗМЕНЕН");
            }else{
                show_result("ОШИБКА: НЕ УДАЛОСЬ ИЗМЕНИТЬ ПАРОЛЬ ПОЛЬЗОВАТЕЛЯ"); 
            }
    }else{
        show_result("ЗАПОЛНЕНА НЕ ВСЯ ФОРМА ИЛИ ПАРОЛЬ И ЕГО ПОДТВЕРЖДЕНИЕ НЕ СОВПАДАЮТ");
    }
}

//Удаление пользователя
if(isset($_POST['del_user'])){
    if(!empty($_POST['admin_del_user_select']) &&
        !empty($_POST['admin_del_user_pass_text'])){
            $check_admin = check_admin($_POST['admin_del_user_pass_text']);
            if($check_admin){
                $del_user_select = $_POST['admin_del_user_select'];
                $check_del = del_user($del_user_select);
                if($check_del){
                    show_result("ПОЛЬЗОВАТЕЛЬ УСПЕШНО УДАЛЕН");
                }else{
                    show_result("ОШИБКА: ПОЛЬЗОВАТЕЛЬ НЕ БЫЛ УДАЛЕН"); 
                }
            }else{
                show_result("НЕВЕРНЫЙ ПАРОЛЬ АДМИНИСТРАТОРА");
            }
    }else{
        show_result("ЗАПОЛНЕНА НЕ ВСЯ ФОРМА");
    }
}

//Вывод логов
if(isset($_POST['show_logs'])){
    if(!empty($_POST['admin_pass_logs'])){
        $check_admin = check_admin($_POST['admin_pass_logs']);
        if($check_admin){
            show_logs();
        }else{
            show_result("НЕВЕРНЫЙ ПАРОЛЬ АДМИНИСТРАТОРА");
        }
    }else{
        show_result("ЗАПОЛНЕНА НЕ ВСЯ ФОРМА");
    }
}

//вывод результата и возврат к admin.php
if(isset($_POST['return_to_admin'])){
    header("Location: ../views/admin.php");
}
?>