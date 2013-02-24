<?php
require '../funcs.php';

$max = 0;
$realonline = 0;
$align = center;

foreach ($servers as $servername) {
    $ip = $ips[$servername];
    $port = $ports[$servername];
    $max += $maxonline[$servername];
    $res += get_res($ip,$port);
    if (isset($res['report'])) $res['online'] = 0; 
    $realonline .= $res['online'];
} 
    
$img = imagecreatefrompng(dirname(__FILE__).'/extensions/allonline.png');                         
?>
