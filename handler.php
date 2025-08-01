<?php
$title = "проверка вебхука";

$url = "https://laempresa.bitrix24.es/rest/1/l0fvjh738yy1v0qk/crm.lead.add.json?"
."fields[TITLE]=" . urlencode($title);


$leadData= file_get_contents ($url);
$JSdata = json_decode ($leadData);
$test = print_r ($JSdata);

echo $test;
?>
