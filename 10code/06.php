<?php
/**
 * PHP 裁剪图片
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2016/7/29
 * Time: 23:36
 */

$file = 'ybxyq.jpg';
list($srcW,$srcH,$type,$attr) = getimagesize($file);

$srcIm = imagecreatefromjpeg($file);
/* 画白板 */
$dstIm = imagecreatetruecolor($srcW,$srcH);
$white = imagecolorallocate($dstIm,255,255,255);
imagefill($dstIm,0,0,$white);

imagecopy($dstIm,$srcIm,0,0,0,0,$srcW,$srcH);

imagepng($dstIm);
