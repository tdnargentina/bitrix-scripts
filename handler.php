<?php

// Настройки портала
$domain = "laempresa.bitrix24.es";
$webhook = "1/hloshe3nj97bypps";

// Получаем тело запроса Bitrix24 (JSON)
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Проверка, что пришли данные от onCrmDynamicItemAdd
if (!$data || !isset($data['data']['FIELDS']['ID'])) {
    http_response_code(400);
    exit('Нет данных');
}

// ID элемента и тип SPA
$elementID = $data['data']['FIELDS']['ID'];
$entityTypeId = $data['data']['FIELDS']['ENTITY_TYPE_ID'];

// Здесь можно фильтровать по конкретному SPA, например entityTypeId = 179
if ($entityTypeId != 179) {
    exit('Это не нужный SPA');
}

// Новое название
$newTitle = "Новое название SPA 123" . $elementID;

// Формируем payload для обновления элемента
$fields = [
    "TITLE" => $newTitle
];

$params24 = [
    "entityTypeId" => $entityTypeId,
    "id" => $elementID,
    "fields" => $fields
];

$url = "https://{$domain}/rest/{$webhook}/crm.item.update.json";

// Отправляем POST-запрос с JSON
$options = [
    "http" => [
        "method"  => "POST",
        "header"  => "Content-Type: application/json",
        "content" => json_encode($params24, JSON_UNESCAPED_UNICODE)
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$json = json_decode($response, true);

// Логируем результат (опционально)
file_put_contents('log.txt', date('Y-m-d H:i:s') . " " . print_r($json, true) . "\n", FILE_APPEND);

// Отвечаем Bitrix24
echo json_encode(["result" => "ok"]);


?>

