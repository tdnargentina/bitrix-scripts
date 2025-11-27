<?php


// Читаем JSON от Bitrix
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Достаём ID нового SPA
$spaId = $data["data"]["FIELDS"]["ID"] ?? null;

if (!$spaId) {
    echo "No SPA ID received";
    exit;
}

// ---- Настройки Bitrix ----
$domain = "laempresa.bitrix24.es";
$webhook = "1/hloshe3nj97bypps";
$dealID = 2453;

// ---- Обновляем сделку ----
$fields = [
    "TITLE" => (string)$spaId,
    "UF_CRM_646374B11172B" => 1,
    "UF_CRM_649AF1D374E3B" => 1735
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

// Выводим ответ Bitrix (для проверки)
echo $result;


?>




