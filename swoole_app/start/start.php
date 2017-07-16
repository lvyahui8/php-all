<?php
/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2016/3/17
 * Time: 17:23
 */
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__.'/../library/functions.php';



$localDBConf = config('db.local');

$database = array(
    'driver'    => 'mysql',
    'host'      => $localDBConf['host'],
    'port'      => $localDBConf['port'],
    'database'  => $localDBConf['name'],
    'username'  => $localDBConf['user'],
    'password'  => $localDBConf['pass'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
);

//use  Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

/*创建连接*/
$capsule->addConnection($database);
/*设置全局访问*/
$capsule->setAsGlobal();
/*启动Eloquent*/
$capsule->bootEloquent();
