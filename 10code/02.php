<?php
/**
 * 随机生成颜色
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2016/7/29
 * Time: 23:04
 */
function randomColor(){
    $color = '#';
    $hexMap = array(
        10  =>  'A',
        11  =>  'B',
        12  =>  'C',
        13  =>  'D',
        14  =>  'E',
        15  =>  'F',
    );
    for($i = 0;$i < 6; $i++){
        $randNum = rand(0,15);
        $color .= $randNum < 10 ? $randNum : $hexMap[$randNum];
    }
    return $color;
}

echo randomColor();
echo randomColor();
echo randomColor();