<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require_once "config/SERVER.php";

$link = new mysqli(SERVER,USER,PASS,DB) or die("Error " . mysqli_error($link));
$query="SET NAMES 'utf8'";
$link->query($query);

if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

?>