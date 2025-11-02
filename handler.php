

<?php 
$domain = "laempresa.bitrix24.es";  // домен Bitrix24
$webhook = "1/l0fvjh738yy1v0qk";    // ключ вебхука

$deals = [
    "eaa426" => 2461,
    "wbb155" => 2463,
    "agf923" => 2431
];

$key = $_GET["key"] ?? '';

if (!isset($deals[$key])) {
    die("<h1 style='color:red;text-align:center;margin-top:40px;'>ДОСТУП ЗАПРЕЩЁН</h1>");
}

$dealID = $deals[$key];

$url = "https://{$domain}/rest/{$webhook}/crm.deal.get.json?id={$dealID}";
$response = file_get_contents($url);
$jsonDecode = json_decode($response, true);

$title = $jsonDecode["result"]["TITLE"] ?? "Без названия";
$stage = $jsonDecode["result"]["STAGE_ID"] ?? "UNKNOWN";

switch ($stage) {
    case 14: $stageText = "Начало оформления"; break;
    case "NEW": $stageText = "Заполнение формуляров"; break;
    case "UC_UVTI2O": $stageText = "Переводы документов"; break;
    case "PREPAYMENT_INVOICE": $stageText = "Оплата необходимых сборов"; break;
    case "EXECUTING": $stageText = "Финальная проверка комплекта"; break;
    case "FINAL_INVOICE": $stageText = "Загрузка документов в ЛК"; break;
    case "WON": $stageText = "Одобрение получено 🎉"; break;
    case "LOSE": $stageText = "В одобрении отказано"; break;
    default: $stageText = "Неизвестная стадия";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Статус оформления ВНЖ</title>
<style>
    body {
        font-family: "Segoe UI", Roboto, sans-serif;
        background: linear-gradient(135deg, #ffe259, #ffa751);
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        padding: 40px;
        max-width: 420px;
        width: 90%;
        text-align: center;
        animation: fadeIn 0.6s ease;
    }
    .card h1 {
        color: #d32f2f;
        margin-bottom: 10px;
    }
    .card h2 {
        color: #333;
        font-size: 1.2rem;
        font-weight: normal;
        margin-bottom: 30px;
    }
    .stage {
        background: #ffebee;
        border-left: 6px solid #d32f2f;
        padding: 15px;
        border-radius: 8px;
        font-size: 1.1rem;
        color: #444;
        font-weight: 500;
    }
    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(20px);}
        to {opacity: 1; transform: translateY(0);}
    }
    footer {
        position: fixed;
        bottom: 10px;
        width: 100%;
        text-align: center;
        color: rgba(255,255,255,0.8);
        font-size: 0.9rem;
    }
</style>
</head>
<body>
<div class="card">
    <h1>Статус вашего запроса</h1>
    <h2><?= htmlspecialchars($title) ?></h2>
    <div class="stage"><?= htmlspecialchars($stageText) ?></div>
</div>
<footer>© <?= date("Y") ?> Все права защищены.</footer>
</body>
</html>










