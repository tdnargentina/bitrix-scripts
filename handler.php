<?php

$domain  = 'laempresa.bitrix24.es';
$webhook = '1/hloshe3nj97bypps';

// Проверяем, что запрос пришёл от БП
if (!isset($_POST['document_id'][2])) {
    die('No deal ID');
}

$dealID = $_POST['document_id'][2];

// Часовой пояс (важно!)
date_default_timezone_set('Europe/Moscow');

// Только время
$timeOnly = date('H:i:s');

$fields = [
    'UF_CRM_1738841842511' => $timeOnly
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


?>





