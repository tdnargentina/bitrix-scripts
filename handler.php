<?php
      // БОЛЕЕ КОРРЕКТНЫЙ СКРИПТ ДЛЯ МЕТОДОВ БИТРИКС

// Настройки подключения к Bitrix24
$spaDtata = ['data']['FIELDS']['ID'];
$domain = "laempresa.bitrix24.es";  // домен твоего портала Bitrix24
$webhook = "1/hloshe3nj97bypps";    // часть вебхука (ключ авторизации)
$dealID = 2453;                     // ID сделки, которую будем обновлять
// Данные для обновления сделки
$fields = [
    "UF_CRM_646374B11172B" => 1,     // пользовательское поле Да/Нет (1 = Да, 0 = Нет)
    "TITLE" => $spaDtata,               // новое название сделки
	"UF_CRM_649AF1D374E3B" => 1735, // выводим страну 
];
// Собираем параметры запроса (что будем отправлять в Bitrix24)
$postData = [
    "id" => $dealID,    // ID сделки
    "fields" => $fields // какие поля обновить
];
// Адрес метода Bitrix24 (crm.deal.update)
$url = "https://{$domain}/rest/{$webhook}/crm.deal.update.json";
// Описание параметров HTTP-запроса (что именно отправляем и как)
$options = [
    "http" => [
        "method"  => "POST",                              // метод запроса (POST)
        "header"  => "Content-Type: application/x-www-form-urlencoded", // тип данных (форма)
        "content" => http_build_query($postData)          // данные, закодированные в строку (id=2417&fields[...]=...)
    ]
];
//  Создаём "контекст" — упаковку набора настроек, которые мы указали выше в $options
$context  = stream_context_create($options);
// Отправляем запрос к Bitrix24 и получаем ответ (JSON-строка)
$result = file_get_contents($url, false, $context);
// Превращаем JSON-строку из Bitrix24 в PHP-массив
$response = json_decode($result, true);
// Красиво выводим результат на экран для проверки
echo "<pre>";          // тег <pre> делает текст форматированным (читаемым)
print_r($response);    // выводит массив в удобном виде
echo "</pre>";
?>


