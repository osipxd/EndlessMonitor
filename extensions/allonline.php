<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta name="author" content="OsipXD" />
    <meta name="copyright" content="EndlessWorlds" />
    <meta charset="utf-8">
    <style type="text/css">
        @font-face {               
            font-family: Style-Font;
            src: url(<?php echo '..',$style_path,'/',$style,'/font.ttf'; ?>);
        }
        p {
            font-family: Style-Font, serif, cursive;
            font-size: 14px; /* Тут менять размер шрифта */
        }
    </style>
</head>

<?php 
require '../config.php';  

if ($debug) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);    
}

// Получаем информацию с серверов
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
        } else $online = 0;
    }
    return $online;
}

$max = 0;
$real = 0;

foreach ($servers as $servername) {
    $ip = $ips[$servername];
    $port = $ports[$servername];
    $max += $maxonline[$servername]; 
    $real += get_res($ip,$port);
    file_put_contents('last.txt', $real.'/'.$max);
    file_put_contents('cron.txt', time());
}

$all = file_get_contents('last.txt');

if ($debug) {
    ini_set('display_errors', 0);
    error_reporting(0);    
}
?> 
<body>
    <p> Общий онлайн: <?php echo $all; ?> </p>
</body>
</html>