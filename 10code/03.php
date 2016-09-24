<?php
/**
 * 从网络下载文件
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2016/7/29
 * Time: 23:12
 */

set_time_limit(0);

$url = 'http://movesun.com/images/ybxyq.jpg';

$pi = pathinfo($url);
$ext = $pi['extension'];
$name = $pi['filename'];

/*$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_HEADER,false);
curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
curl_setopt($ch,CURLOPT_AUTOREFERER,true);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$fileContent = curl_exec($ch);
curl_close($ch);*/

$fileContent = file_get_contents($url);


$saveFile = $name.'.'.$ext;

if(preg_match_all("/[^0-9a-z._-]/i",$saveFile)){
    $saveFile = md5(microtime(true)).'.'.$ext;
}

/*
$handle = fopen($saveFile, 'wb');
fwrite($handle, $fileContent);
fclose($handle);
*/
file_put_contents($saveFile,$fileContent);
