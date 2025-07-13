<?php

$file = "test.txt";
$content = "тестовый лог";


file_put_contents ($file, $content);

$vivod = file_get_contents($file);

echo $vivod;

?>