#!/usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2017/10/23
 * Time: 22:16
 */
require_once 'MailSender.php';

$arguments=getopt('s:m:');

$mailSender = new MailSender();

$mailSender->sendText($arguments['s'],$arguments['m'],array('1257069076@qq.com'));