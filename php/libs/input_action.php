<?php
/**
 * файл группы Input
 * 
 * используется для внесения данных о лицах в БД
 * 
 * @author Евгений Свириденко <partagas@mail.ru>
 * @version Persona 1.0 дата релиза 18.11.2014
 * @copyright Е.Свириденко 2014
 */
 
header("Content-Type: text/html; charset=utf-8");

require_once "sanitize.lib.php";
require_once "db_conn.lib.php";

if(isset($_POST['name_input']) &&
    isset($_POST['sur_input']) &&
    isset($_POST['name_lat_input']) &&
    isset($_POST['sur_lat_input']) &&
    isset($_POST['birth_input']) &&
    isset($_POST['civil_input']) &&
    isset($_POST['pass_input']) &&
    isset($_POST['number_input']) &&
    isset($_POST['number_auto_input']) &&
    isset($_POST['info_date_input']) &&
    isset($_POST['info_country_input']) &&
    isset($_POST['info_dir_input']) &&
    isset($_POST['info_ppr_input']) &&
    isset($_POST['info_who_input']) &&
    isset($_POST['sort_input']) &&
    isset($_POST['quant_input_select']) &&
    isset($_POST['quant_input']) &&
    isset($_POST['price_input_select']) &&
    isset($_POST['price_input']) &&
    isset($_POST['fab_input_text'])){
    
        // Прием и обработка данных
        $name_input = sanitize_str($_POST['name_input']);
        $sur_input = sanitize_str($_POST['sur_input']);
        $name_lat_input = sanitize_str($_POST['name_lat_input']);
        $sur_lat_input = sanitize_str($_POST['sur_lat_input']);
        $birth_input = sanitize_date($_POST['birth_input']);
        $civil_input = sanitize_str($_POST['civil_input']);
        $pass_input = sanitize_str($_POST['pass_input']);
        $number_input = sanitize_str($_POST['number_input']);
        $number_auto_input = sanitize_str($_POST['number_auto_input']);
        $info_date_input = sanitize_date($_POST['info_date_input']);
        $info_country_input = sanitize_str($_POST['info_country_input']);
        $info_dir_input = sanitize_str($_POST['info_dir_input']);
        $info_ppr_input = sanitize_str($_POST['info_ppr_input']);
        $info_who_input = sanitize_str($_POST['info_who_input']);
        $sort_input = sanitize_str($_POST['sort_input']);
        $quant_input_select = sanitize_str($_POST['quant_input_select']);
        $quant_input = sanitize_int($_POST['quant_input']);
        $price_input_select = sanitize_str($_POST['price_input_select']);
        $price_input = sanitize_int($_POST['price_input']);
        $fab_input_text = sanitize_str($_POST['fab_input_text']);
        
        // Запись данных в БД
        
        $query_ins_pers = "INSERT INTO persons (persons_id, name, sur, name_lat, sur_lat, birth,
        						civil, passport, number_pers, number_auto, sys_date
        			) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";             
                                
        $stmt_1 = $db_conn->prepare($query_ins_pers);
        
        // Данные из переменных и их обработка для ввода в БД
        $persons_id = NULL;
        $name_input = $db_conn->real_escape_string($name_input);
        $sur_input = $db_conn->real_escape_string($sur_input);
        $name_lat_input = $db_conn->real_escape_string($name_lat_input);
        $sur_lat_input = $db_conn->real_escape_string($sur_lat_input);
        $birth_input = $db_conn->real_escape_string($birth_input);
        $civil_input = $db_conn->real_escape_string($civil_input);
        $pass_input = $db_conn->real_escape_string($pass_input);
        $number_input = $db_conn->real_escape_string($number_input);
        $number_auto_input = $db_conn->real_escape_string($number_auto_input);
        $sys_date = create_sys_date();
       
        //PHP-подготовленные запросы
        $stmt_1->bind_param("issssssssss", $persons_id, $name_input, $sur_input, $name_lat_input, $sur_lat_input,
                                $birth_input, $civil_input, $pass_input, $number_input, $number_auto_input, $sys_date);
        
        $stmt_1->execute();
        //$stmt_1->close();
        
        $query_ins_info = "INSERT INTO info_fab (persons_id, date_info, 
                            country, direction,	ppr, who, fab, sys_date)
                            VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt_2 = $db_conn->prepare($query_ins_info);
        
        $persons_id = $db_conn->insert_id;
        $info_country_input = $db_conn->real_escape_string($info_country_input);
        $info_dir_input = $db_conn->real_escape_string($info_dir_input);
        $info_ppr_input = $db_conn->real_escape_string($info_ppr_input);
        $info_who_input = $db_conn->real_escape_string($info_who_input);
        $fab_input_text = $db_conn->real_escape_string($fab_input_text);
        
        $stmt_2->bind_param("isssssss", $persons_id, $info_date_input, $info_country_input, $info_dir_input,
        						$info_ppr_input, $info_who_input, $fab_input_text, $sys_date);
                                
        $stmt_2->execute();
        //$stmt_2->close();                                          
        
        $query_ins_tmc = "INSERT INTO tmc (persons_id, sort, quant_sel,	quant, price_sel, price, sys_date)
                            VALUES(?, ?, ?,	?, ?, ?, ?)";
        
        $stmt_3 = $db_conn->prepare($query_ins_tmc);
        
        //$persons_id = $db_conn->insert_id;
        $sort_input = $db_conn->real_escape_string($sort_input);
        $quant_input_select = $db_conn->real_escape_string($quant_input_select);
        $quant_input = $db_conn->real_escape_string($quant_input);
        $price_input_select = $db_conn->real_escape_string($price_input_select);
        $price_input = $db_conn->real_escape_string($price_input);
        
        $stmt_3->bind_param("issisis", $persons_id, $sort_input, $quant_input_select,
                                $quant_input, $price_input_select, $price_input, $sys_date);
                                
        $stmt_3->execute();
        $stmt_3->close();
        
        $db_conn->close();
        
        // Возврат к странице input.php с очисткой формы
        header("Location: ../views/input.php");
        exit; 
    
} //endif isset($_POST['name_input'])

?>