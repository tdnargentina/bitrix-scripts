





<?php

$domain  = 'aaavito.bitrix24.ru';
$webhook = '1/x9b95otr4d3jeqzx';

$acc1DealID = $_GET['deal_id'] ?? null;;

$url1 = "https://{$domain}/rest/{$webhook}/crm.deal.get.json?id={$acc1DealID}";

$zapusk1 = file_get_contents ($url1);
$jsdecode1 = json_decode ($zapusk1,true);

$title = $jsdecode1["result"]["TITLE"];
$resp = $jsdecode1["result"]["ASSIGNED_BY_ID"];
$country = $jsdecode1["result"]["UF_CRM_1770371193434"];

//меняем ID ответственного
$respChange = [
1 => 1,
16 => 6,
22 => 29
];
$Newresp = $respChange[$resp]?? null;

// меняем страну
$countryChange = [
44 => 1731,
46 => 1735,
48 => 1729,
50 => 1733
];

$newCountry = $countryChange[$country]?? null;


// Детали создания сделки на Ла Емпреса
$domainLa  = "laempresa.bitrix24.es";
$webhookLa = "1/hloshe3nj97bypps";

$fieldsLa = [
"TITLE" => $title,
"ASSIGNED_BY_ID" => $Newresp,
"UF_CRM_649AF1D374E3B" => $newCountry
];

$params24La = [
"fields"=> $fieldsLa
];


$urlLA = "https://{$domainLa}/rest/{$webhookLa}/crm.deal.add.json";

$settings = [
"http" => [
"method" => "POST",
"header" => "Content-Type: application/x-www-form-urlencoded",
"content" => http_build_query ($params24La)
]
];

$upakovla = stream_context_create ($settings);

$zapuskLA = file_get_contents ($urlLA,false,$upakovla);

?>





