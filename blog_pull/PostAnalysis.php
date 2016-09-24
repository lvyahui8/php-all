<?php

/**
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2016/7/17
 * Time: 20:38
 */
class PostAnalysis
{
    protected $url;

    protected $content;

    /**
     * 图片路径
     * @var array
     */
    protected $images = array();

    /**
     * PostAnalysis constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
        $this->content = file_get_contents($url);
    }


}