<?php

$domain  = 'aaavito.bitrix24.ru';
$webhook = '1/x9b95otr4d3jeqzx';

$DealId = $_POST["data"]["FIELDS"]["ID"];

$dealURL = "https://{$domain}/rest/{$webhook}/crm.deal.get.json?id={$DealId}";

$zapuskDeal = file_get_contents ($dealURL);
$jsDeal = json_decode ($zapuskDeal,true);
$resp = $jsDeal["result"]["ASSIGNED_BY_ID"];
$country = $jsDeal["result"]["UF_CRM_1770371193434"];

if ($country==44){

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

?>









