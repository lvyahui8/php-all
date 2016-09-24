<?php
/*
 * http://phpsnips.com/128/Spam-Filter#.V5tqbYR96Hs
 * */

/**
 * 黑名单过滤
 * @param $text
 * @param $file
 * @param string $split
 * @param bool $regex
 * @return bool
 */
function is_spam($text,$file,$split = ':',$regex = false){
    /* 一次性读到内存 */
    $handle = fopen($file,'rb');
    $contents = fread($handle,filesize($file));
    fclose($handle);

    /* 解析黑名单字典 */
    $lines = explode("\n",$contents);
    $arr = array();
    foreach($lines as $line){
        list($word,$count) = explode($split,$line);
        $arr[$regex ? $word : preg_quote($word)] = $count;
    }

    /* 匹配出关键词 */
    preg_match_all('~'.implode('|',array_keys($arr)).'~',$text,$matches);

    /* 统计关键词出现的次数，如果大于黑名单指定的次数，则返回真 */
    $temp = array();
    foreach($matches[0] as $match){
        if(!in_array($match,$arr)){
            if(!isset($temp[$match])) $temp[$match] = 0;
            $temp[$match] = $temp[$match] + 1;
            if($temp[$match] >= $arr[$match]){
                return true;
            }
        }
    }
    return false;
}

$file = 'spam.txt';
$str = 'This string has the word viagra and sex get viagra see viagra';
if(is_spam($str,$file)){
    echo 'this is spam';
}else{
    echo 'this is not spam';
}
