<?php
/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2017/4/28
 * Time: 18:00
 */

require_once __DIR__.'/../start/start.php';

require_once __DIR__.'/../app/model/Post.php';

$posts = \App\Model\Post::all();
if(!$posts->isEmpty()){
    foreach($posts as $post){
        echo "{$post->title}\n";
    }
}