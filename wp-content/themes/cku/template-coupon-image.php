<?php
 header('Content-type: image/png');
 $coupon = imagecreatefrompng('images/discount-coupon.png');
 imagettftext($coupon, 14, 0, 23, 117, imagecolorallocate($coupon,0,0,0), 'font/font-gothic.ttf', urldecode($_GET['youname']));
 imagettftext($coupon, 10, 0, 16, 145, imagecolorallocate($coupon,255,255,255), 'font/font-arial.ttf', 'Купон № ' . preg_replace('/[^0-9]/i','',$_COOKIE['rnc']) . ', действителен до ' . date('d.m.Y',strtotime('+7 day',time())) . ' г.');
 imagepng($coupon);
 imagepng($coupon, '../../uploads/coupon-images/'.preg_replace('/[^0-9]/i','',$_COOKIE['rnc']).'.png');
 imagedestroy($coupon);
 exit();
?>
