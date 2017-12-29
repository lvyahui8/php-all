<?php
/**
 */

//$str = "xxxx/v3.6.3:20170919_1";
//
//if(preg_match("/\\/([\\d\\w\\.]+)\\:/i",
//    $str,
//    $matche)){
//    print_r($matche);
//}


$content = file_get_contents("F:/temp/xxx.html");
//$regex = "(magnet:\\?[\\d\\w]+=[=\\w:\\d&%;\\.\\(\\)]+)";
//$regex = "/(magnet:\\?\\S+)(?=\\<)/";
$regex = "/>(magnet:\\?\\S+)</";
if(preg_match_all($regex,$content,$matches)){
    foreach($matches[0] as $item){
        echo "=================================================\n";
        $item = str_ireplace("&amp;","&",$item);
        $item = str_ireplace("%5B","[",$item);
        $item = str_ireplace("%5D","]",$item);
        echo $item."\n";
    }
}