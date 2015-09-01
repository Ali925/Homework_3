<?php

$name = $_GET["name"];

$address = "./files/$name";

$handle = fopen($address, 'r');

echo nl2br(fread($handle, filesize($address)));

fclose($handle);



?>