<?php
/**
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2016/8/13
 * Time: 10:30
 */


class T{
    static $serv ;
    static $conf = array(
        'worker_num'               => 1,    // 工作进程数量. 设置为CPU的1-4倍最合理
        'max_request'              => 0,     // 防止 PHP 内存溢出, 一个工作进程处理 X 次任务后自动重启 (注: 0,不自动重启)
        'max_conn'                 => 10000, // 最大连接数
        'task_worker_num'          => 1,     // 任务工作进程数量
        'task_max_request'         => 0,     // 防止 PHP 内存溢出
        'task_tmpdir'              => '/tmp',
        'dispatch_mode'            => 2,
        'backlog'                  => 128,
        'heartbeat_check_interval' => 10,    // 心跳检测间隔时长(秒)
        'heartbeat_idle_time'      => 20,   // 连接最大允许空闲的时间
        'socket_buffer_size'         => 3,
        'buffer_output_size'         => 3,
    );
}