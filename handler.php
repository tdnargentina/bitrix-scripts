<?php

// СТАВИМ onCrmDynamicItemAdd в исходящий вебхук и указаываем адрес обработчика 
$domain = "laempresa.bitrix24.es";
$webhook = "1/hloshe3nj97bypps";

$DEALId = $_POST["data"]["FIELDS"]["ID"];  

$urlGet = "https://{$domain}/rest/{$webhook}/crm.deal.get.json?id={$DEALId}";
$zapuskGet = file_get_contents($urlGet);
$getdecode = json_decode($zapuskGet, true);


$fieldData = $getdecode["result"]["UF_CRM_1738841842511"];


$massivOtv = [
    1  => 1,
    6  => 6,
    29 => 29
];

$responsible = $massivOtv[$fieldData];

$fields = [
"TITLE"=> "Сделка из обработчика id=$DEALId",
"ASSIGNED_BY_ID" =>$responsible 
];

$params24 = [
"id" => $DEALId,
"fields" => $fields
];

$urlUpd = "https://{$domain}/rest/{$webhook}/crm.deal.update.json";

$settings = [
"http" => [
"method" => "POST",
"header" => "Content-Type: application/x-www-form-urlencoded",
"content" => http_build_query ($params24)
]
];

$upakovka = stream_context_create ($settings);
$zapusk = file_get_contents ($urlUpd, false,$upakovka);

?>





