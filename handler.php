<?php

// Bitrix шлёт данные как обычную форму — читаем $_POST
$spaId = $_POST['data']['FIELDS']['ID'] ?? null;

if (!$spaId) {
    error_log("ERROR: SPA ID not found. POST: " . print_r($_POST, true));
    echo "NO SPA ID";
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

// Логируем ответ
error_log("Bitrix update response: " . $result);

// Отдаём назад
echo $result;

?>






