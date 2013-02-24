<?php
// Закругляем края картинки (если надо)
function rounding($img) {
    global $radius;
    global $rate;
    if ($radius > 10) $radius = 10;

    imagealphablending($img, false);
    imagesavealpha($img, true);
    $width = imagesx($img);
    $height = imagesy($img);
    $rs_radius = $radius * $rate;
    $rs_size = $rs_radius * 2;
    $corner = imagecreatetruecolor($rs_size, $rs_size);
    imagealphablending($corner, false);
    $trans = imagecolorallocatealpha($corner, 255, 255, 255, 127);
    imagefill($corner, 0, 0, $trans);
    $positions = array(
        array(0, 0, 0, 0),
        array($rs_radius, 0, $width - $radius, 0),
        array($rs_radius, $rs_radius, $width - $radius, $height - $radius),
        array(0, $rs_radius, 0, $height - $radius),
    );
    foreach ($positions as $pos) {
        imagecopyresampled($corner, $img, $pos[0], $pos[1], $pos[2], $pos[3], $rs_radius, $rs_radius, $radius, $radius);
    }
    $lx = $ly = 0;
    $i = -$rs_radius;
    $y2 = -$i;
    $r_2 = $rs_radius * $rs_radius;
    for (; $i <= $y2; $i++) {
        $y = $i;
        $x = sqrt($r_2 - $y * $y);
        $y += $rs_radius;
        $x += $rs_radius;
        imageline($corner, $x, $y, $rs_size, $y, $trans);
        imageline($corner, 0, $y, $rs_size - $x, $y, $trans);
        $lx = $x;
        $ly = $y;
    }

    foreach ($positions as $i => $pos) {
        imagecopyresampled($img, $corner, $pos[2], $pos[3], $pos[0], $pos[1], $radius, $radius, $rs_radius, $rs_radius);
    }
    return $img;
}

// Получаем информацию с сервера
function get_res($address,$port) {
    global $full_mess;
    global $off_mess;
    global $err_mess;
    global $full; 
    
    $socket = @fsockopen($address,$port);
    if ($socket == false)  $res['report'] = $off_mess; 
    else {
        @fwrite($socket, "\xFE");
        $cash = "";
        $cash = @fread($socket, 1024);
        @fclose($socket);
        if ($cash !== false && substr($cash, 0, 1) == "\xFF") {
            $info = explode("\xA7", mb_convert_encoding(substr($cash,1), 'iso-8859-1', 'utf-16be'));
            $res['online'] = $info[1];
            $res['max'] = $info[2];
            if ($res['online']==$res['max'] && $full) $res['report'] = $full_mess;
        } else $res['report'] = $err_mess;
    }
    return $res;
}

function htmlcolor($img,$color) {
    sscanf($color, '%2x%2x%2x', $red, $green, $blue);
    return ImageColorAllocate($img,$red,$green,$blue);
    return($c);
}

// Выравнивание надписи
function align($img,$font_size,$font,$text) {
    global $leftright;
    global $updown;
    global $align;
    $box = imagettfbbox($font_size, 0, $font, $text);
    if ($align == 'left') $position['x'] = 4 - $leftright;
    elseif ($align == 'right') $position['x'] = imagesx($img) - ($box[2]-$box[0]) - 4 - $leftright;
    else $position['x'] = (imagesx($img) - ($box[2]-$box[0]))/2-$leftright;
    $position['y'] = (imagesy($img) + ($box[1]-$box[7]))/2-$updown;
    return $position;
}
?>