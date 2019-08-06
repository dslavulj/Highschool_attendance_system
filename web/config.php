<?php
define('DB_SERVER', '192.168.56.105');
define('DB_USERNAME', 'X');
define('DB_PASSWORD', 'X');
define('DB_NAME', 'Srednja Skola');
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$link->set_charset("utf8");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>