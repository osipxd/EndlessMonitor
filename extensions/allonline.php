<?php
require '../config.php';

// Получаем информацию с сервера
function get_res($address,$port) {  
    $socket = @fsockopen($address,$port);
    if ($socket == false)  $online = 0; 
    else {
        @fwrite($socket, "\xFE");
        $cash = "";
        $cash = @fread($socket, 1024);
        @fclose($socket);
        if ($cash !== false && substr($cash, 0, 1) == "\xFF") {
            $info = explode("\xA7", mb_convert_encoding(substr($cash,1), 'iso-8859-1', 'utf-16be'));
            $online = $info[1];
        }
    }
    return $online;
}

$max = 0;
$realonline = 0;

foreach ($servers as $servername) {
    $ip = $ips[$servername];
    $port = $ports[$servername];
    $max += $maxonline[$servername];
    $realonline += get_res($ip,$port);
} 

echo 'Общий онлайн: ', $realonline, '/', $max;                         
?>
