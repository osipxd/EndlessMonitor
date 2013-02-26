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
if (isset($_GET['debug'])) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);    
}
require '../../config.php';
require '../../serverlist.php';  

$max = 0;
$real = 0;



foreach ($servers as $servername) {
    $max += $maxonline[$servername]; 
    $real += get_res($ip,$port);
}

if (isset($_GET['debug'])) {
    ini_set('display_errors', 0);
    error_reporting(0);    
}
?> 
<body>
    <p> Общий онлайн: <?php echo $real,'/',$max; ?> </p>
</body>
</html>