<?php
/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2017/2/20
 * Time: 17:22
 */



$routeMap = array(
    'api/list'  =>  array(
        'file'  =>  'api_list.php',
        'type'  =>  'json'
    ),
);
function getPath(){
    $uri = $_SERVER['REQUEST_URI'];
    $script_filename = $_SERVER['SCRIPT_FILENAME'];
    $document_root = $_SERVER['DOCUMENT_ROOT'];

    return ltrim($uri,rtrim(ltrim($script_filename,$document_root),'index.php'));
}

$path = getPath();
$data = null;
if(isset($routeMap[$path])){
    $routeConfig = $routeMap[$path];
    if(isset($routeConfig['target'])){
        if(is_string($routeConfig['target'])){
            // json file
            $file = __DIR__.'/data/'.$routeConfig['file'];
            if(file_exists($file)){
                $data =  require_once $file;
            }
        } else if(is_array($routeConfig['target'])){
            //
        }
    }
}

header("Content-type:application/json");
echo json_encode($data);
exit;