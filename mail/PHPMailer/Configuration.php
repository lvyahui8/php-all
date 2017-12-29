
<?php

/**
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2017/10/23
 * Time: 22:40
 */
class Config
{
    private $last_update_time;

    private $config;

    /**
     * Configuration constructor.
     */
    public function __construct()
    {
        $this->config = require 'config.php';
    }

    public function get($prop){
        if(is_string($prop)){
            if(!strpos($prop,'.')){
                return $this->config[$prop];
            }else{
                $names = explode('.',$prop);
                $val =  $this->config[$names[0]];
                $num = count($names);
                for($i = 1; $i < $num;$i ++){
                    $val = $val[$names[$i]];
                }
                return $val;
            }
        }else{
            return null;
        }
    }
}