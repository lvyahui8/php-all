<?php
/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2016/9/26
 * Time: 13:17
 */

function post($url,$data){
    $curl = curl_init($url);
    curl_setopt($curl,CURLOPT_POST,1);
    curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;
}

//$resp = post('http://10.254.99.44:8000/tdbus/common',file_get_contents('post.data'));
//echo $resp;

$content = urldecode(file_get_contents("D:/SNGAPM/data.txt"));
$rows = explode("\n",$content);
echo count($rows);
exit();
