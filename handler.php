
<?php
$domain  = 'aaavito.bitrix24.ru';
$webhook = '1/nthi0g5a4kz8biro';

$lead_ID = $_REQUEST['data']['FIELDS']['ID'] ?? null;

$urlGET = "https://{$domain}/rest/{$webhook}/crm.lead.update.json";

$fields = [
'id' => $lead_ID,
"fields" => [
'TITLE' => 'Проверка связи'
]
];


$params = [
'http'=> [
'method' => 'POST',
'header' => 'Content-Type: application/x-www-form-urlencoded',
'content' => http_build_query ($fields)
]
];

$upakovka = stream_context_create($params);

$zapusk = file_get_contents ($urlGET, false,$upakovka);
?>
