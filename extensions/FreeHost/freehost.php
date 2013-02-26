<?php
include 'dbconnect.php';

if (isset($_GET['debug'])) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);    
}
$mysqli = new mysqli($dbhost.':'.$port, $dbuser, $dbpass, $db);
if ($mysqli->connect_errno) { 
    echo 'Could not connect to MySQL: (', $mysqli->connect_errno, ') ', $mysqli->connect_error;
} elseif (!$mysqli->query('SELECT COUNT(*) FROM'.$dbtable)) {
    $online = 0;
    $res['report'] = $off_mess;
} else $res['online'] = $mysqli->query('SELECT COUNT(*) FROM'.$dbtable);

if (isset($_GET['debug'])) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);    
}
?>