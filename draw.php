<?php
$server = isset($_GET['server']) ? $_GET['server'] : 'server'; 
$text = isset($_GET['text']) ? $_GET['text'] : '';
$icon_img = isset($_GET['icon']) ? $_GET['icon'] : '';

$path = dirname(__FILE__);
$style = $style_path.'/'.$style;
include $path.$style.'/style.php';
$port = $ports[$server];
$address = $ips[$server];   
                           
$img = imagecreatetruecolor($width,$height);  
$res = get_res($address,$port);
$font = $path.$style.'/font.ttf';
if(isset($res['report'])) {
    $err_img = '/offline.png';
    if ($res['report'] == $full_mess) {
	    $err_img = '/full.png';
		$font_offline_color = $font_full_color;
	}
    $bg = imagecreatefrompng($path.$style.$err_img);
	imagecopy($img, $bg, 0, 0, 0, 0, imagesx($img), imagesy($img));
	$pos = align($img,$font_size,$font,$res['report']);
	imagettftext($img,$font_size,0,$pos['x'], $pos['y'],htmlcolor($img,$font_offline_color),$font,$res['report']);
	imagedestroy($bg);
} else {
    $percent = $width*$res['online']/$res['max'];
	$bg = imagecreatefrompng($path.$style.'/online.png');
	$position = imagesx($bg)/2 - $percent;
	imagecopy($img, $bg, 0, 0, $position, 0, imagesx($img), imagesy($img));
	if($text != '') {
        if ($capital) $text = strtoupper($text);
        $desc = $text." ".$res['online'].'/'.$res['max'];
    }
	else $desc = $res['online'].'/'.$res['max'];
	$pos = align($img,$font_size,$font,$desc);
	imagettftext($img, $font_size, 0, $pos['x'], $pos['y'], htmlcolor($img,$font_online_color), $font, $desc);
	imagedestroy($bg);
}

if($icon_img != '' && is_readable($path.$icon_path.'/'.$icon_img) && !isset($res['report'])) {
	$icon = imagecreatefrompng($path.$icon_path.'/'.$icon_img);
	imagecopy($img, $icon, 2+$ileftright, 2-$iupdown, 0, 0, imagesx($icon), imagesy($icon));
	imagesavealpha($img, true);
	imagedestroy($icon);
}

if ($border) {
    for($i = 0; $i < $height; $i++) {
	    if(($i == 0) OR ($i == $height-1)) imageline ($img, 0, $i, $width, $i, htmlcolor($img,$border_color));
	    imagesetpixel($img, 0, $i, htmlcolor($img,$border_color));
	    imagesetpixel($img, $width-1, $i, htmlcolor($img,$border_color));
    }
}

if ($radius > 0) $img = rounding($img);

$path .= $save_path.'/'.$file_name.'.png';
if(is_readable($path)) unlink($path);
 
imagepng($img,$path);
imagedestroy($img);
?>