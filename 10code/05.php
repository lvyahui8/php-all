<?php
/**
 * 时间差异计算函数
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2016/7/29
 * Time: 23:28
 * @param $time
 * @return string
 */

function ago($time){
    $periods = array('second','minute','hour','day','week','month','year','decade');
    $lengths = array('60','60','24','7','4.35','12','10');
    $now = time();
    $diff = $now - $time;
    $tense = 'ago';

    for($i = 0;$diff >= $lengths[$i] && $i < count($lengths) - 1; $i++){
        $diff /= $lengths[$i];
    }

    $diff = round($diff);

    if($diff !== 1){
        $periods[$i] .= 's';
    }

    return "$diff $periods[$i] $tense";
}

echo ago(time() + 1004000000000);