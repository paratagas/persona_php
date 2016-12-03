<?php
/**
 * библиотека функций для проверки и обработки введенных данных
 * 
 * используется в файлах admin_action.php, input_action.php, output.php, index_action.php
 * 
 * @author Евгений Свириденко <partagas@mail.ru>
 * @version Persona 1.0 дата релиза 18.11.2014
 * @copyright Е.Свириденко 2014
 */
 
header("Content-Type: text/html; charset=utf-8");


/**
   * функция sanitize_str($data)
   * 
   * используется для проверки и обработки строк
   * 
   * @param string $data строка с данными
   * @return string строка с обработанными данными
*/
function sanitize_str($data){
    if($data == ""){
        $data = "НЕ УКАЗАНО";
        return $data;
    }elseif($data == "...\n"){
        $data = "НЕ УКАЗАНО";
        return $data;
    }elseif($data == "..."){
        $data = "НЕ УКАЗАНО";
        return $data;
    }else{
        $data = strval($data);
        $data = trim($data);
        $data = strip_tags($data);
        //$data = addslashes($data);
        //$data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return $data;
    }
}


/**
   * функция sanitize_pass($pass)
   * 
   * используется для проверки и обработки паролей
   * 
   * @param string $pass строка с паролем
   * @return string строка с обработанным паролем
*/
function sanitize_pass($pass){
    $pass = strval($pass);
    $pass = trim($pass);
    $pass = strip_tags($pass);
    return $pass;
}


/**
   * функция sanitize_date($data)
   * 
   * используется для проверки и обработки даты
   * 
   * @param string $data строка с датой
   * @return string строка с обработанной датой
*/
function sanitize_date($data){
    if($data != ""){
        $data = date_create_from_format('Y-m-d', $data);
        $data = date_format($data, 'Y-m-d');
        return $data;
    }else{
        $data = "0000-00-00";
        return $data;
    }
}


/**
   * функция sanitize_int($data)
   * 
   * используется для проверки и обработки чисел
   * 
   * @param string $data строка с числом
   * @return integer целое число
*/
function sanitize_int($data){
    $data = trim($data);
    $data = strip_tags($data);
    $data = intval($data);
    if(preg_match('/^[\d]+$/', $data)){
        return $data;
    }else{
        $data = 0;
        return $data;
    }	
}


/**
   * функция create_sys_date()
   * 
   * используется для ввода даты и времени внесения изменений в БД в нужном формате
   * 
   * @return string строка с датой
*/
function create_sys_date(){
        $sys_date = date('Y-m-d H:i:s');
        return $sys_date;
}

/**
   * функция secure_pass($pass)
   * 
   * используется для обработки паролей
   * 
   * @param string $pass строка с паролем
   * @return string строка с паролем в виде 40-значного 16-ричного числа
*/
function secure_pass($pass){
	$salt_1 = "g5tu6v";
    $salt_2 = "mn8s4x";
    $pass = $salt_1.$pass.$salt_2;
    $pass = sha1($pass);
    return $pass;
}
?>