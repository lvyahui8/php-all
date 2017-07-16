<?php
/*
 * Created by PhpStorm.
 * User: samlv
 * Date: 2016/3/17
 * Time: 13:38
 */

$conf = include(__DIR__.'/../config/config.php');
if (!defined('ZIP_DATA_CONF')) {
    define('ZIP_DATA_CONF', json_encode($conf));
}
function config($prop)
{
    static $_conf = null;
    if (!$_conf) {
        $_conf = json_decode(ZIP_DATA_CONF, true);
    }
    if (is_string($prop)) {
        if (!strpos($prop, '.')) {
            return isset($_conf[$prop]) ? $_conf[$prop] : null;
        } else {
            $names = explode('.', $prop);
            $val = $_conf[$names[0]];
            $num = count($names);
            for ($i = 1; $i < $num; $i++) {
                $val = $val[$names[$i]];
            }
            return $val;
        }
    } else {
        return null;
    }
}

date_default_timezone_set('PRC');