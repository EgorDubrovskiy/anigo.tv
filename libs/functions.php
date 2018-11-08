<?php

function countFiles($name_dir)
{
    $dir = opendir($name_dir);
    $count = 0;
    while($file = readdir($dir)){
        if($file == '.' || $file == '..' || is_dir($name_dir . $file)){
            continue;
        }
        $count++;
    }
    return $count; 
}

function countDir($dirs)
{
    $i = 0;
    $list = scandir($dirs);
    foreach($list as $dr)
    {
        if ($dr!='.' AND $dr!='..')
        {
            if (is_dir($dirs."/".$dr)) $i++;
        }
    }
    return $i;
}

/*
 склонение существительных 
 параметры: число, версия слова на число один,2,5
 пример: declOfNum($n,'просмотр','просмотра','просмотров');
 */
function declOfNum($number, $one, $two, $five) 
{
     if (($number - $number % 10) % 100 != 10) 
     {
         if ($number % 10 == 1) 
         {
             $result = $one;
         } elseif ($number % 10 >= 2 && $number % 10 <= 4) 
         {
             $result = $two;
         } else 
         {
             $result = $five;
         }
     } else 
     {
         $result = $five;
     }
     return $result;
}

//переводит строку с кирилицей в массив символов
function str_split_utf8($str) {
    $split = 1;
    $array = array();
    for ($i=0; $i < strlen($str); ){
        $value = ord($str[$i]);
        if($value > 127){
            if ($value >= 192 && $value <= 223)      $split = 2;
            elseif ($value >= 224 && $value <= 239)  $split = 3;
            elseif ($value >= 240 && $value <= 247)  $split = 4;
        } else $split = 1;
        $key = NULL;
        for ( $j = 0; $j < $split; $j++, $i++ ) $key .= $str[$i];
        array_push( $array, $key );
    }
    return $array;
}

//проверка  - "я не робот"
function recapCheck()
{
    //отправляем запрос с данными капчи
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $key = '6Le2GEIUAAAAAJ2zgwPV-gYsb87KzUzZyy65ZcX-';
    $query = $url.'?secret='.$key.'&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR'];//$_SERVER['REMOTE_ADDR'] -айпи адрес текущего сайта

    //отправляем запрос с данными капчи на сервер гугл
    $data_recap = json_decode(file_get_contents($query));

    return $data_recap->success;
}

function getUrl() {
  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
  $url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
  $url .= $_SERVER["REQUEST_URI"];
  return $url;
}

function ValidFormTab($str)//возврящает строку содержащую только символы англ. алвавита исходной строки в нижнем регистре
{
   return mb_strtolower(implode(preg_grep('~[a-z,A-Z]~',str_split($str))));
}

function count_files($dir)
{ 
    $c=0; // количество файлов. Считаем с нуля
    $d=dir($dir); // 
    while($str=$d->read()){ 
        if($str{0}!='.'){ 
            if(is_dir($dir.'/'.$str)) $c+=count_files($dir.'/'.$str); 
            else $c++; 
        }
    } 
    $d->close(); // закрываем директорию
    return $c; 
}

//класс для генерации кнопок переход для выбора части контента (1,2,3,4,5,6,7,8,9,10...100)
class Jump_buttons
{
    /*
    функция определяет от куда и до куда читать данные из бд ()
    $n количество кнопок для перехода на др страницы*/
    //i and n - от и до 
    public static function selectiveContent(&$n, &$i,&$N, $amount_data, $present_value, $amount_data_per_page){
        $n = $amount_data/$amount_data_per_page;/*количество кнопок для перехода на др страницы*/
        if($amount_data%$amount_data_per_page != 0)
        {
            $n++;
        }

        /*расчёты для вывода статей*/
        $i=0;$N=0;/*определяем с кокого и до кокого flyer читаем*/
        if($present_value)
        {
            $i=$present_value*$amount_data_per_page-$amount_data_per_page;
            if($present_value != (int)$n)
            {
                $N = $present_value*$amount_data_per_page;
                /*echo $N;*/
            }
            else 
            {
                if((int)((int)$amount_data%$amount_data_per_page) != 0)
                $N = $i + (int)((int)$amount_data%$amount_data_per_page);
                else  $N = $i +$amount_data_per_page;
            }
        }
        else 
        {
            $i=0;
            $N=$amount_data_per_page;
        }
    }

    public static function cout_buttons($present_value, $i, $n, &$text, $className, $classNameActive, $onclick)
    {
        for(; $i<=$n; $i++)
        {
            if($i==$present_value)
            {
                $text .='<div class="'.$classNameActive.'" " onclick="'.$onclick.'" >'.$i.'</div>';
            }
            else 
            {
                $text .='<div class="'.$className.'" " onclick="'.$onclick.'" >'.$i.'</div>';
            }
        }
    }

    /*
    кнопки перехода по страницам 1,2,3,...
    функция для создания кнопок перехода по данным c помощью get запроса
    аргументы:
    $present_value - текущее значение
    $n - место с которого считывались данные при выводе в текущий блок
    $N - место до которого считывались данные при выводе в текущий блок
    */
    public static function jump_buttons_generation($present_value, $n, $N, &$text, $className, $classNameActive, $onclick)
    {
        if($present_value-1 > 6)
        {
            if($n-$present_value >6)
            {
                $text .='<div class="'.$className.'" " onclick="'.$onclick.'" >1</div><div class="'.$className.'">...</div>';
                Jump_buttons::cout_buttons($present_value, $present_value-4, $present_value+4, $text, $className, $classNameActive, $onclick);
                $text .='<div class="'.$className.'">...</div><div class="'.$className.'" " onclick="'.$onclick.'" >'.$n.'</div>';
            }
            else
            {
                if($n>12)
                {
                    $text .='<div class="'.$className.'" " onclick="'.$onclick.'" >1</div><div class="'.$className.'">...</div>';
                    Jump_buttons::cout_buttons($present_value, $n-10, $n, $text, $className, $classNameActive, $onclick);
                }
                else
                {
                    Jump_buttons::cout_buttons($present_value, 1, $n, $text, $className, $classNameActive, $onclick);
                }
            }
        }
        else
        {
            if($n-$present_value > 6)
            {
                if($n>12)
                {
                    Jump_buttons::cout_buttons($present_value, 1, 10, $text, $className, $classNameActive, $onclick);
                    $text .='<div class="'.$className.'">...</div><div class="'.$className.'" " onclick="'.$onclick.'" >'.$n.'</div>';
                }
                else
                {
                   Jump_buttons::cout_buttons($present_value, 1, $n, $text, $className, $classNameActive, $onclick); 
                }
            }
            else
            {
                Jump_buttons::cout_buttons($present_value, 1, $n, $text, $className, $classNameActive, $onclick);
            }
        }
    }
    //определяем с какого места выводить чат если он существует

    /*
    функция для возврата результата генерации кнопок
    $present_value;//номер кнопки перехода которую выбрали
    $number_of_rec_per_page - кол-во записей на одной странице
    $table_size - кол-во записей в бд (всего)
    */
    public static function Get($present_value,$table_size,$number_of_rec_per_page, $className, $classNameActive, $onclick){
        $iBegin;$n;$N;
        Jump_buttons::selectiveContent($n, $iBegin,$N, $table_size, $present_value,$number_of_rec_per_page);

        //кнопки
        $history = "";

        $n=(int)$n;
        Jump_buttons::jump_buttons_generation($present_value, $n, $N, $history,$className, $classNameActive, $onclick);
        
        $res = array(
        
            "buttons" => $history,
            "iBegin" => $iBegin,//считывание из бд - от
            "iEnd" => $N,//считывание из бд - до 
            "countBut" => $n//кол-во кнопок
        );
        
        return $res;
    }
}

class RandValue
{
    public static function RandDate($from, $to)
    {
        //for example
        //from = 1262055681
        //to = 1265056681
        return date("Y-m-d H:i:s",mt_rand($from,$to));
    }
    
    function RandStr($length){
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }
}

?>