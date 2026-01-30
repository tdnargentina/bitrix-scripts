
<?php

$domain  = 'laempresa.bitrix24.es';
$webhook = '1/hloshe3nj97bypps';

$testDID = 2509;

$fields = [
'TITLE'=> "DEAL AS LOG"
];

$b24params = [
'id' => $testDID,
'fields' => $fields
];

$url1 = "https://{$domain}/rest/{$webhook}/crm.deal.update.json";
$settingsPHP = [
'http' => [
'method'=> 'POST',
'header' => 'Content-Type: application/x-www-form-urlencoded',
'content' => http_build_query($b24params)
]
];


$upakovka = stream_context_create($settingsPHP);
$zapusk = file_get_contents($url,false,$upakovka);





// ID сделки из БП
$dealID = $_POST["data"]["FIELDS"]["ID"];    

// ТОЛЬКО ВРЕМЯ
$time = time('H:i:s'); // или 'H:i'

// Поля сделки
$fields = [
    'UF_CRM_1738841842511' => $time,
	'TITLE' => "REST DEAL"
];

$params24 = [
    'id' => $dealID,
    'fields' => $fields
];

$url = "https://{$domain}/rest/{$webhook}/crm.deal.update.json";

$settings = [
    'http' => [
        'method'  => 'POST',
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query($params24)
    ]
];

$context = stream_context_create($settings);
$response = file_get_contents($url, false, $context);
$result = json_decode($response, true);

// Отладка
echo "<pre>";
print_r($result);
echo "</pre>";


?>






