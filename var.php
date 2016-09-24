<?php
/**
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2016/7/23
 * Time: 15:25
 */

$a  =  1 ;
$b  =  2 ;

function  Sum ()
{
    global  $a ,  $b ;

    $b  =  $a  +  $b ;
}

Sum ();
echo  $b ;

function  test ()
{
    static  $a  =  0 ;
    echo  $a ;
    $a ++;
}

$a = 'hello';

$$a = 'world';

echo "$a ${$a}\n";// hello world
