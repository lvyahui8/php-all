<?php
/**
 * Alexa和谷歌网页排名
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2016/7/29
 * Time: 23:24
 */

function page_rank($page, $type = 'alexa'){
    $handle = false;
    switch($type){
        case 'alexa':
            $url = 'http://alexa.com/siteinfo/';
            $handle = fopen($url.$page, 'r');
            break;
        case 'google':
            $url = 'http://google.com/search?client=navclient-auto&ch=6-1484155081&features=Rank&q=info:';
            $handle = fopen($url.'http://'.$page, 'r');
            break;
    }
    if(!$handle) return false;
    $content = stream_get_contents($handle);
    fclose($handle);
    $content = preg_replace("~(n|t|ss+)~",'', $content);
    switch($type){
        case 'alexa':
            if(preg_match('~<div class="data (down|up)"><img.+?>(.+?) </div>~im',$content,$matches)){
                return $matches[2];
            }else{
                return false;
            }
            break;
        case 'google':
            $rank = explode(':',$content);
            if($rank[2] != '')
                return $rank[2];
            else
                return false;
            break;
        default:
            return false;
            break;
    }
}
// Alexa Page Rank:
echo 'Alexa Rank: '.page_rank('techug.com');
echo "\n";
// Google Page Rank
echo 'Google Rank: '.page_rank('techug.com', 'google');