<?php

$domain = 'laempresa.bitrix24.es';
$webhook = '1/hloshe3nj97bypps';

$dealID = $_POST["data"]["FIELDS"]["ID"];


$fields = [
'TITLE' => 'REST DEAL PHP SERVER',
'UF_CRM_649AF1D374E3B' => 1735,
];

$params24 = [
'id' => $dealID,
'fields' => $fields
];

$url = "https://{$domain}/rest/{$webhook}/crm.deal.update.json";

$settings =[
'http' => [
"method" => 'POST',
'header' => 'Content-Type: application/x-www-form-urlencoded',
'content' => http_build_query ($params24)
]
];

$context = stream_context_create ($settings);
$zapusk = file_get_contents($url, false,$context);
$jsonDecode = json_decode($zapusk,true);

echo "<pre>";
print_r ($jsonDecode);
echo "</pre>";
?>







