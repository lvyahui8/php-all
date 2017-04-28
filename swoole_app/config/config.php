<?php
/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2017/4/28
 * Time: 17:53
 */

return array(
    /**
     * 数据库配置
     */
    'db'               => array(
        /**
         *
         */
        'remote' => array(
            'host' => 'localhost',
            'port' => 3306,
            'name' => 'remote',
            'user' => 'root',
            'pass' => 'root',
        ),
        /**
         * 最终的分析结果存储的数据库地址，也是默认被Eloquent使用的默认的连接地址
         */
        'local'  => array(
            'host' => '127.0.0.1',
            'port' => '3306',
            'name' => 'dblog',
            'user' => 'root',
            'pass' => 'root',
        ),
    ),

);