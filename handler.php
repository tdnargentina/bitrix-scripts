<?php

// СТАВИМ onCrmDynamicItemAdd в исходящий вебхук и указаываем адрес обработчика 
$domain = "laempresa.bitrix24.es";
$webhook = "1/hloshe3nj97bypps";

$spaENTITY_TYPE_ID = $_POST["data"]["FIELDS"]["ENTITY_TYPE_ID"];
$spaID = $_POST["data"]["FIELDS"]["ID"];

$urlGet = "https://{$domain}/rest/{$webhook}/crm.item.get.json?entityTypeId={$spaENTITY_TYPE_ID}&id={$spaID}";

$zapuskGet = file_get_contents($urlGet);
$getDecode = json_decode ($zapuskGet, true);
$employeeID = $getDecode["result"]["item"]["ufCrm19_1723554092730"]; 

if (!isset($getDecode["result"]["item"]["ufCrm19_1723554092730"])) {
    die("Employee ID not found in response");
}

$newID = [
  1  => 1,
  6  => 6,
  29 => 29
];

$responsible = $newID[$employeeID];

$fields = [
"title"=> "SPA REST 05/12",
"assignedById" => $responsible
];

$params = [
"entityTypeId" => $spaENTITY_TYPE_ID,
"id" => $spaID,
"fields"=> $fields
];

$urlUpdate = "https://{$domain}/rest/{$webhook}/crm.item.update.json";

$settings = [
"http"=>[
"method"=> "POST",
"header" => "Content-Type: application/x-www-form-urlencoded",
"content" => http_build_query ($params)
]
];

$contextUPAKOVKA = stream_context_create ($settings);
$zapuskUpd = file_get_contents ($urlUpdate,false,$contextUPAKOVKA);

?>


