<?php
/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2016/10/2
 * Time: 13:40
 */

$path = __DIR__;
$files = scandir($path);
$_7day = strtotime("-7 day");
echo date("Y-m-d H:i:s",$_7day)."\n";
foreach($files as $file){
    if($file === '.' || $file === '..'){
        continue;
    }
//    print_r($file);
    if(filectime($file) < $_7day){
        echo $file;
    }
    echo "\n";
}