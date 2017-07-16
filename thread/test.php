<?php
/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2017/3/30
 * Time: 13:28
 */

//测试扩展pthreads是否安装成功
class AsyncOperation extends Thread {

    private $arg;

    public function __construct($arg){
        $this->arg = $arg;
    }

    public function run(){
        if($this->arg){
            printf("Hello %s\n", $this->arg);
        }
    }

}

$thread = new AsyncOperation("World");
if($thread->start()){

    //$thread->join();
    echo "thread starting\n";
}

sleep(3);
echo "samlv\n";
exit;