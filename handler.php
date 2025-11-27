<?php

// При создании СПА запускается обработчки который меняет ответсвенного в этом СПА

// ---- Настройки Bitrix ----
$domain = "laempresa.bitrix24.es";
$webhook = "1/hloshe3nj97bypps";

// Bitrix шлёт данные как обычную форму — читаем $_POST и получаем:
$spaId = $_POST["data"]["FIELDS"]["ID"]; // Получаем ID созданного элемента
$entityTypeId = $_POST["data"]["FIELDS"]["ENTITY_TYPE_ID"];// Идентификатор раздела SPA

// Указываем данные для изменения 
$title = "SPA с новым ответственным REST API"; // указываем название элемента
$responsible = 6; //указываем ответсвенного

// Передаем изменения в переменные Битрикс

$fields = [
"title" => $title,
"assignedById" => $responsible
];

// Оборачиваем настройки для Битрикс

$params = [
"entityTypeId" => $entityTypeId,
"id" => $spaId,
"fields" => $fields
];


// Пишем URL c нужным методом
$url = "https://{$domain}/rest/{$webhook}/crm.item.update.json";

// Собираем запрос

$settings = [
"http" => [
"method" => "POST",
"header" => "Content-Type: application/x-www-form-urlencoded",
"content" => http_build_query ($params)
]
];

// Создаем упаковку настроек
$context = stream_context_create ($settings);

// Запускаем
$zapusk = file_get_contents ($url, false, $context);

?>
