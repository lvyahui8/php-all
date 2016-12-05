<?php
/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2016/10/16
 * Time: 14:56
 */

// 当文件被占用时，执行rm是否会失败
$file = 'file';
file_put_contents($file,'hello');

$fp = fopen($file,'rw');
sleep(10);
echo fread($fp,5)."\n";
fclose($fp);