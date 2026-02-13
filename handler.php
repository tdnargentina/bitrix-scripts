<?php

// В случае выигрыша код передает название Сделки Ответственного и Списочную страну с одного аккаунта на другой
// В финальной стадии лидов первого аккаунта необходимо указать обработчик:
// https://bitrix-scripts.onrender.com?deal_id={{ID}}


// Домен и вебхук первого портала (откуда забираем сделку)
$domain  = 'aaavito.bitrix24.ru';
$webhook = '1/x9b95otr4d3jeqzx';

// Получаем ID сделки из GET-параметра URL
$acc1DealID = $_GET['deal_id'] ?? null;

// Формируем URL запроса к REST API для получения сделки
$url1 = "https://{$domain}/rest/{$webhook}/crm.deal.get.json?id={$acc1DealID}";

// Выполняем GET-запрос к API
$zapusk1 = file_get_contents($url1);

// Декодируем JSON-ответ в массив
$jsdecode1 = json_decode($zapusk1, true);

// Забираем название сделки
$title = $jsdecode1["result"]["TITLE"];

// Забираем ID ответственного
$resp = $jsdecode1["result"]["ASSIGNED_BY_ID"];

// Забираем пользовательское поле "Страна"
$country = $jsdecode1["result"]["UF_CRM_1770371193434"];


// ---------------- Сопоставление ответственных ----------------

// Массив соответствия ID ответственных (старый → новый портал)
$respChange = [
    1  => 1,
    16 => 6,
    22 => 29
];

// Меняем ответственного по сопоставлению
$Newresp = $respChange[$resp] ?? null;


// ---------------- Сопоставление стран ----------------

// Массив соответствия значений списка стран
$countryChange = [
    44 => 1731,
    46 => 1735,
    48 => 1729,
    50 => 1733
];

// Получаем новое значение страны
$newCountry = $countryChange[$country] ?? null;


// ---------------- Данные второго портала (куда создаем сделку) ----------------

// Домен второго портала
$domainLa  = "laempresa.bitrix24.es";

// Вебхук второго портала
$webhookLa = "1/hloshe3nj97bypps";


// Формируем массив полей новой сделки
$fieldsLa = [
    "TITLE" => $title,                 // Название сделки
    "ASSIGNED_BY_ID" => $Newresp,      // Новый ответственный
    "UF_CRM_649AF1D374E3B" => $newCountry // Новая страна
];

// Оборачиваем поля в параметр fields для REST API
$params24La = [
    "fields" => $fieldsLa
];


// URL метода создания сделки
$urlLA = "https://{$domainLa}/rest/{$webhookLa}/crm.deal.add.json";


// Настройки HTTP-запроса (POST)
$settings = [
    "http" => [
        "method"  => "POST", // Метод запроса
        "header"  => "Content-Type: application/x-www-form-urlencoded", // Тип контента
        "content" => http_build_query($params24La) // Кодируем параметры
    ]
];

// Создаем контекст потока с настройками
$upakovla = stream_context_create($settings);

// Выполняем POST-запрос на создание сделки
$zapuskLA = file_get_contents($urlLA, false, $upakovla);

?>






