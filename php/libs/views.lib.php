<?php
/**
 * библиотека функций для заполнения опций select в HTML-коде форм
 * 
 * используется в файлах input.php, output.php
 * 
 * @internal отстутствие функции trim() или ее аналогов при обработке данных из текстовых файлов может стать причиной трудноуловимой ошибки при работе с базой данных.
 * @internal При кажущемся соответствии с параметром запроса данные не будут совпадать из-за наличия неотображаемых символов вроде \n, присутствующих в файлах *.txt
 * @author Евгений Свириденко <partagas@mail.ru>
 * @version Persona 1.0 дата релиза 18.11.2014
 * @copyright Е.Свириденко 2014
 */
 
define("PATH_SELECT", "../../txt/");

/**
   * функция fill_select($txt_file)
   * 
   * используется для заполнения опций select в коде форм,
   * например, пунктов пропуска или стран
   * путем извлечения строк из соответствующих файлов в папке txt
   * 
   * @param string $txt_file строка с именем файла
*/
function fill_select($txt_file){
    if(file_exists(PATH_SELECT.$txt_file)){
        $file_array = file(PATH_SELECT.$txt_file);
        foreach ($file_array as $option) {
            $option = rtrim($option);
    	    echo "<option value='$option'>$option</option>";
        }
    }else{
         $error_select = "Нет необходимых данных";
         echo "<option value='no_value'>$error_select</option>";
    }
}

?>