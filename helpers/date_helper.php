<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function getMonthName($no)
{
    $month = '';
    if($no == '01') $month = 'января';
    elseif($no == '02') $month = 'февраля';
    elseif($no == '03') $month = 'марта';
    elseif($no == '04') $month = 'апреля';
    elseif($no == '05') $month = 'мая';
    elseif($no == '06') $month = 'июня';
    elseif($no == '07') $month = 'июля';
    elseif($no == '08') $month = 'августа';
    elseif($no == '09') $month = 'сентября';
    elseif($no == '10') $month = 'октября';
    elseif($no == '11') $month = 'ноября';
    elseif($no == '12') $month = 'декабря';
    return $month;
}
function getMonthShortName($no)
{
    $month = '';
    if($no == '01') $month = 'янв';
    elseif($no == '02') $month = 'фев';
    elseif($no == '03') $month = 'мар';
    elseif($no == '04') $month = 'апр';
    elseif($no == '05') $month = 'мая';
    elseif($no == '06') $month = 'июн';
    elseif($no == '07') $month = 'июл';
    elseif($no == '08') $month = 'авг';
    elseif($no == '09') $month = 'сен';
    elseif($no == '10') $month = 'окт';
    elseif($no == '11') $month = 'ноя';
    elseif($no == '12') $month = 'дек';
    return $month;
}

function getDayOfWeek($day, $month, $year)
{
    $day = jddayofweek ( cal_to_jd(CAL_GREGORIAN, $month, $day, $year) , 1 );
    
    $day = str_replace('Monday', 'Понедельник', $day);
    $day = str_replace('Tuesday', 'Вторник', $day);
    $day = str_replace('Wednesday', 'Среда', $day);
    $day = str_replace('Thursday', 'Четверг', $day);
    $day = str_replace('Friday', 'Пятница', $day);
    $day = str_replace('Saturday', 'Суббота', $day);
    $day = str_replace('Sunday', 'Воскресенье', $day);
    
    return $day;
}

function getMonthName2($no)
{
    $month = '';
    if($no == '01') $month = 'январь';
    elseif($no == '02') $month = 'февраль';
    elseif($no == '03') $month = 'март';
    elseif($no == '04') $month = 'апрель';
    elseif($no == '05') $month = 'май';
    elseif($no == '06') $month = 'июнь';
    elseif($no == '07') $month = 'июль';
    elseif($no == '08') $month = 'август';
    elseif($no == '09') $month = 'сентябрь';
    elseif($no == '10') $month = 'октябрь';
    elseif($no == '11') $month = 'ноябрь';
    elseif($no == '12') $month = 'декабрь';
    return $month;
}

function getWordDate($date, $no_year = false)
{
    if($date != '')
    {
        $dtArr = explode(' ', $date);
        if(isset($dtArr[0])) {
            $arr = explode('-', $dtArr[0]);
            $ret = $arr[2] . ' ' . getMonthName($arr[1]);
            if (!$no_year) $ret .= ' ' . $arr[0];
        }
        if(isset($dtArr[1])) $ret .= ' '.$dtArr[1];
        return $ret;
    }
    else return '';
}

function getWordDateTime($date, $no_year = false)
{
    if($date != '')
    {
        $dtArr = explode(' ', $date);
        if(isset($dtArr[0])) {
            $arr = explode('-', $dtArr[0]);
            $ret = $arr[2] . ' ' . getMonthName($arr[1]);
            if (!$no_year) $ret .= ' ' . $arr[0];
        }
        if(isset($dtArr[1])) $ret .= $dtArr[1];
        return $ret;
    }
    else return '';
}

function getDayByUnix($date_unix){
    return date('d', $date_unix);
}

function getMonthNumByUnix($date_unix){
    return date('m', $date_unix);
}

?>