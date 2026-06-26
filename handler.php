<?php

// ОБРАБОТЧИК - На Обновление лида (ONCRMLEADUPDATE) 
// ID изменяемого лида можно получить в $_REQUEST['data']['FIELDS']['ID'] ?? null;


$domain  = 'aaavito.bitrix24.ru';
$webhook = '1/nthi0g5a4kz8biro';

$lead_ID = $_REQUEST['data']['FIELDS']['ID'] ?? null;

$urlGET = "https://{$domain}/rest/{$webhook}/crm.lead.get.json";

$b24params = [
'id' => $lead_ID
];


$requestParams = [
'http' => [
'method' => 'POST',
'header' => 'Content-Type: application/x-www-form-urlencoded',
'content' => http_build_query ($b24params)
]
];

$upakovka = stream_context_create ($requestParams);
$zapusk = file_get_contents ($urlGET, false, $upakovka);
$jsDecode = json_decode ($zapusk, true);
$stage = $jsDecode ['result']['STATUS_ID'];
// другие поля лида для передачи
$name1 = $jsDecode ['result']['TITLE'];
$responsibleID = $jsDecode ['result']['ASSIGNED_BY_ID'];
$country = $jsDecode ['result']['UF_CRM_1772618596431'];

// РАБОТА СО ВТОРЫМ АККАУНТОМ

if ($stage !== 'JUNK') {
    die;
}
$domain2  = 'laempresa.bitrix24.es';
$webhook2 = '1/hloshe3nj97bypps';

$urlLeadAdd = "https://{$domain2}/rest/{$webhook2}/crm.lead.add.json";
// --Ответсвенный
$respChange = [
    1  => 1,
    16 => 6,
    22 => 29
];

$Newresp = $respChange[$responsibleID] ?? null;
//Страна
$countryChange = [
    64  => 2663, // Аргентина
    62 => 2665, // Мексика
    66 => 2667, // Колумбия
	60 => 2669 // Испания
];

$newCountry = $countryChange[$country] ?? null;


$fields2 = [
'fields' => [
'TITLE' => $name1,
'ASSIGNED_BY_ID' => $Newresp,
'UF_CRM_1782465890794' => $newCountry
]
];


$requestParams2 = [
'http' => [
'method' => 'POST',
'header' => 'Content-Type: application/x-www-form-urlencoded',
'content' => http_build_query ($fields2)
]
];

$upakovka2 = stream_context_create ($requestParams2);
$zapusk2 = file_get_contents ($urlLeadAdd, false, $upakovka2);

?>
