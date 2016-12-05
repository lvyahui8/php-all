<?php
/**
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2016/9/24
 * Time: 19:22
 */


header('Content-Type:application/json');
date_default_timezone_set('Asia/Shanghai');
$startTime = date("H:i:s");
if(isset($_GET['sleep'])){
    sleep(intval($_GET['sleep']));
}

echo json_encode(array(
    'code'  =>  0,
    'msg'   =>  'success',
    'data'  =>  array_merge(array(
        'start_time'  =>  $startTime,
        'end_time'  =>  date("H:i:s"),
    ),$_GET)
));
exit(0);
