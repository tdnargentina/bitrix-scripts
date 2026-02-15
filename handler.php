<?php

// В случае выигрыша код передает: название Сделки, Ответственного и Списочную страну с одного аккаунта на другой
// В финальной стадии сделки первого аккаунта необходимо создать робота Исходящий вебхук указать обработчик:
// https://bitrix-scripts.onrender.com?deal_id={{ID}}


// Домен и вебхук первого портала (откуда забираем сделку)
$domain  = 'aaavito.bitrix24.ru';
$webhook = '1/x9b95otr4d3jeqzx';

$DealId = $_POST["data"]["FIELDS"]["ID"];

$dealURL = "https://{$domain}/rest/{$webhook}/crm.deal.get.json?id={$DealId}";

$zapuskDeal = file_get_contents ($dealURL);
$jsDeal = json_decode ($zapuskDeal,true);
$resp = $jsDeal["result"]["ASSIGNED_BY_ID"];
$country = $jsDeal["result"]["UF_CRM_1770371193434"];

if ($country=44){

$fields = [
"fields"=> [
"TITLE"=> "создна сделка для визы в Испанию $DealId",
"RESPONSIBLE_ID" =>$resp,
]
];

$dealURL = "https://{$domain}/rest/{$webhook}/tasks.task.add.json";

$paramsToSend =[
"http" => [
"method" => "POST",
"header" => "Content-Type: application/x-www-form-urlencoded",
"content" => http_build_query ($fields)
]
];

$context = stream_context_create ($paramsToSend);


file_put_contents ($dealURL,false,$context);
}



/*

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
*/
?>







