
<?php

$domain  = 'laempresa.bitrix24.es';
$webhook = '1/hloshe3nj97bypps';

// ID сделки из БП
$dealID = $_POST["data"]["FIELDS"]["ID"];    

// ТОЛЬКО ВРЕМЯ
$time = time('H:i:s'); // или 'H:i'

// Поля сделки
$fields = [
    'UF_CRM_1738841842511' => $time
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






