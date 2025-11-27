<?php

// Читаем входящий JSON от Bitrix24
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Получаем ID созданного SPA
$spaId = $data["data"]["FIELDS"]["ID"] ?? null;

if (!$spaId) {
    file_put_contents("log.txt", "Ошибка: нет ID\n".$input);
    exit("No SPA ID");
}

// Настройки Bitrix24
$domain = "laempresa.bitrix24.es";
$webhook = "1/hloshe3nj97bypps";

// ID сделки, которую нужно обновить (если он статичен)
$dealID = 2453;

// Поля для обновления
$fields = [
    "UF_CRM_646374B11172B" => 1,
    "TITLE" => "SPA #" . $spaId, // Например
    "UF_CRM_649AF1D374E3B" => 1735,
];

$postData = [
    "id" => $dealID,
    "fields" => $fields
];

$url = "https://{$domain}/rest/{$webhook}/crm.deal.update.json";

$options = [
    "http" => [
        "method"  => "POST",
        "header"  => "Content-Type: application/x-www-form-urlencoded",
        "content" => http_build_query($postData)
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

$response = json_decode($result, true);

// ЛОГ (для дебага)
file_put_contents("log.txt", print_r([
    "input" => $data,
    "sent" => $postData,
    "response" => $response
], true));

echo "<pre>";
print_r($response);
echo "</pre>";

?>



