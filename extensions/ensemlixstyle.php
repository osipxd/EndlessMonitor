<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta name="author" content="OsipXD" />
    <meta name="copyright" content="EndlessWorlds" />
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="ensemplixstyle.css">
</head>

<?php
require '../config.php';

$server = isset($_GET['server']) ? $_GET['server'] : 'server';  
?>
<div class="serverimg">
    <a href="<?php echo $infourl[$server] ?>">
        <img src="info.png" width="19" height="19" alt="Server info" >
    </a>
    <a href="<?php echo $mapurl[$server] ?>">
        <img src="map.png" width="19" height="19" alt="Server Map" >
    </a>
</div>
<div class="servertext"><?php echo $ips[$server],':',$ports[$server] ?></div>
</html>