<?php
// Домен
$domain  = 'aaavito.bitrix24.ru';

// Вебхук  
$webhook = '1/nthi0g5a4kz8biro';

$url = "https://{$domain}/rest/{$webhook}/crm.lead.add.json";


$title = 'Lead Rest 2';
$Resp = 16;
$Country = 66; //Колумбия


$fieldsB24 =[
'fields' => [
'TITLE' => $title,
'ASSIGNED_BY_ID' => $Resp,
'UF_CRM_1772618596431' => $Country,
]
];


$requestParams = [
'http' => [
'method' => 'POST',
'header' => 'Content-Type: application/x-www-form-urlencoded',
'content' => http_build_query($fieldsB24)
]
];

$context = stream_context_create ($requestParams);
$run = file_get_contents ($url,false,$context);
$jsDecode = json_decode ($run,true);

echo '<pre>';
print_r ($jsDecode);
echo '</pre>';
?>
