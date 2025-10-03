
<?php
$BitrixDomain = "laempresa.bitrix24.es";
$token = "1/l0fvjh738yy1v0qk"; // твой REST-хук

// =============================
// Сопоставление "секретный токен → deal_id"
$clients = [
    "abc123" => 2407, // клиент 1
    "xyz789" => 2417 // клиент 2
 
];
// =============================

// Берём токен из URL
$userToken = $_GET['key'] ?? '';

// Проверяем, есть ли такой токен
if (!isset($clients[$userToken])) {
    die("Доступ запрещён");
}


// Определяем ID сделки
$dealID = $clients[$userToken];

// Параметры запроса
$params = [
    "id" => $dealID,
];

// Адрес метода Bitrix24
$url = "https://{$BitrixDomain}/rest/{$token}/crm.deal.get.json";

$settings = [
    "http" => [
        "method" => "POST",
        "header" => "Content-Type: application/x-www-form-urlencoded",
        "content" => http_build_query($params)
    ]
];

$context = stream_context_create($settings);
$zapros = file_get_contents($url, false, $context);
$JSdecode = json_decode($zapros, true);

$title = $JSdecode["result"]["TITLE"];
$pais = $JSdecode["result"]["UF_CRM_649AF1D374E3B"];
$status = $JSdecode["result"]["STAGE_ID"];

// Заменяем ID страны на название
switch ($pais) {
    case 1729: $pais = "Аргентина"; break;
    case 1731: $pais = "Испания"; break;
    case 1733: $pais = "Колумбия"; break;
    case 1735: $pais = "Мексика"; break;
}

// Заменяем статус
switch ($status){
    case 14: $status = "Стадия 1"; break;
    case "NEW": $status = "Стадия 2"; break;
    case "UC_UVTI2O": $status = "Стадия 3"; break;
    case "PREPAYMENT_INVOICE": $status = "Стадия 4"; break;
    case "EXECUTING": $status = "Стадия 5"; break;
    case "FINAL_INVOICE": $status = "Стадия 6"; break;
    case "WON": $status = "Сделка завершена успешно"; break;
    case "LOSE": $status = "Сделка неуспешна, отказ"; break;
}

// Вывод
echo "Название сделки: " . htmlspecialchars($title) . "<br>";
echo "Страна: " . htmlspecialchars($pais) . "<br>";
echo "Стадия сделки: " . htmlspecialchars($status) . "<br>";

?>








