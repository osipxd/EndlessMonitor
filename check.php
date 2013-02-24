<?php
require dirname(__FILE__).'/config.php';
//if (!is_writeable(dirname(__FILE__).'/config.php')) echo 'Error: can not open ', dirname(__FILE__), '/config.php';  

if ($debug) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);    
}

$file_name = isset($_GET['name']) ? $_GET['name'] : 'monitor';

// Проверяем надо ли запускать скрипт и если надо, то запускаем
if (!is_writeable('cron.txt')) echo 'Errot: cron.txt can not be write';
else {
    $last_time = file_get_contents('cron.txt');
    $period = time() - 60 * $interval;
    if ($last_time < $period || $debug) {
        include dirname(__FILE__).'/draw.php';
        file_put_contents('cron.txt', time());
    }
}

$img = imagecreatefrompng(dirname(__FILE__).$save_path.'/'.$file_name.'.png');
imageSaveAlpha($img, true);

if ($debug) {
    ini_set('display_errors', 0);
    error_reporting(0);    
}
    
header ('Content-type: image/png');
imagepng($img);
?>