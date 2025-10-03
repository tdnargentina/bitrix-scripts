
<?php


// Настройки подключения к Bitrix24 
$BitrixDomain = "laempresa.bitrix24.es";
$token = "1/l0fvjh738yy1v0qk";
$dealID = 2417;


// Собираем параметры запроса (что будем отправлять в Bitrix24)
$params = [
"id" => $dealID,
];
// Адрес метода Bitrix24 (crm.deal.update)
$url = "https://{$BitrixDomain}/rest/{$token}/crm.deal.get.json";
// Описание параметров HTTP-запроса (что именно отправляем)
$settings = [
"http" => [
"method" => "POST",
"header" => "Content-Type: application/x-www-form-urlencoded",
"content" => http_build_query ($params)
]
];
//  Создаём "контекст" — упаковку набора настроек, которые мы указали выше в $settings
$context = stream_context_create ($settings);
// Отправляем запрос к Bitrix24 и получаем ответ (JSON-строка)
$zapros = file_get_contents ($url, false , $context);
// Превращаем JSON-строку из Bitrix24 в PHP-массив
$JSdecode = json_decode ($zapros, true);

$title = $JSdecode["result"]["TITLE"];
$pais = $JSdecode["result"]["UF_CRM_649AF1D374E3B"];
$status = $JSdecode["result"]["STAGE_ID"];

// Зменяем ID страны на название страны
switch ($pais) {
	case 1729:
	$pais = "Аргентина";
	break;
	case 1731:
	$pais = "Испания";
	break;
	case 1733:
	$pais = "Колумбия";
	break;
	case 1735:
	$pais = "Мексика";
	break;
}

// Зменяем ID стадии на название стадии
switch ($status){
	case 14:
	$status = "Стадия 1";
	break;
	case "NEW":
	$status = "Стадия 2";  
	break;
	case "UC_UVTI2O":
	$status = "Стадия 3";  
	break;
	case "PREPAYMENT_INVOICE":
	$status = "Стадия 4";  
	break;
	case "EXECUTING":
	$status = "Стадия 5";  
	break;
	case "FINAL_INVOICE":
	$status = "Стадия 6";  
	break;
	case "WON":
	$status = "Сделка заверешена успешно";  
	break;
	case "LOSE":
	$status = "Сделка неуспешна, отказ";  
	break;
}

// Красиво выводим результат на экран для проверки

echo "Название сделки: " . $title ."<br>";
echo "Страна: " . $pais ."<br>";
echo "Стадия сделки: " . $status ."<br>";
