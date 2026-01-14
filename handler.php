<?php
$domain = "laempresa.bitrix24.es";
$webhook = "1/hloshe3nj97bypps";

$clients = [
    "pee921" => 2489,
    "try431" => 2485,
    "ofj856" => 2483,
    "ndh801" => 2487
];

$key = $_GET["key"];

if (!isset($clients[$key])) {
    die("<div style='
        font-family: Arial, sans-serif;
        text-align: center;
        margin-top: 100px;
        color: #b00020;
        font-size: 20px;
    '>🚫 Доступ запрещён</div>");
}

$dealID = $clients[$key];
$url = "https://{$domain}/rest/{$webhook}/crm.deal.get.json?id={$dealID}";

$zapusk = file_get_contents($url);
$jsdecode = json_decode($zapusk, true);

$title = $jsdecode["result"]["TITLE"];
$stage = $jsdecode["result"]["STAGE_ID"];
$country = $jsdecode["result"]["UF_CRM_649AF1D374E3B"];
$string = $jsdecode["result"]["UF_CRM_1738841842511"];

// Перевод стадии
switch ($stage) {
    case "C9:NEW": $stage = "Консультация"; break;
    case "C9:PREPARATION": $stage = "Перевод документов"; break;
    case "C9:PREPAYMENT_INVOICE": $stage = "Заполнение анкет"; break;
    case "C9:EXECUTING": $stage = "Оплата сборов"; break;
    case "C9:UC_DKEOZP": $stage = "Финальная проверка"; break;
    case "C9:FINAL_INVOICE": $stage = "Загрузка и отправка документов"; break;
    case "C9:LOSE": $stage = "Отказ в визе"; break;
    case "C9:WON": $stage = "Одобрение визы"; break;
}

// Страна
switch ($country) {
    case 1729: $country = "Аргентина"; break;
    case 1731: $country = "Испания"; break;
    case 1733: $country = "Колумбия"; break;
    case 1735: $country = "Мексика"; break;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Статус оформления</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #fff7e6, #f5d7a3);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background: #fff8f0;
            padding: 35px 45px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            max-width: 420px;
            width: 90%;
            text-align: left;
            animation: fadeIn 0.8s ease-in-out;
            border: 1px solid #f0c674;
        }
        .card h2 {
            color: #7a4b00;
            font-size: 22px;
            margin-bottom: 15px;
        }
        .info {
            margin: 12px 0;
            font-size: 16px;
            color: #333;
        }
        .label {
            font-weight: bold;
            color: #6a3e00;
        }
        .status {
            background: #ffe9b3;
            padding: 8px 12px;
            border-radius: 8px;
            display: inline-block;
            color: #6a3e00;
            font-weight: 600;
            margin-left: 8px;
        }
        .header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header-row">
            <h2>Статус оформления</h2>
            <div class="status"><?= htmlspecialchars($stage) ?></div>
        </div>

        <div class="info"><span class="label">Клиент:</span> <?= htmlspecialchars($string) ?></div>
        <div class="info"><span class="label">Услуга:</span> <?= htmlspecialchars($title) ?></div>
        <div class="info"><span class="label">Страна:</span> <?= htmlspecialchars($country) ?></div>
    </div>
</body>
</html>








