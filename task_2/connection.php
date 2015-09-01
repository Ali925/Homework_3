<?php
$db_host = 'localhost';
$db_database = 'shop';
$db_login = 'root';
$db_password = '';

$mysqli = new mysqli($db_host, $db_login, $db_password, $db_database);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$mysqli->query("set names 'utf8'");
?>