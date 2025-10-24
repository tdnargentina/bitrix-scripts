
<?php
// Получаем данные на LaEmpresa
$dealID = $_GET['deal_id'] ?? null; // ID сделки, которую будем передавать
$domain = "laempresa.bitrix24.es";  // домен твоего портала Bitrix24
$webhook = "1/l0fvjh738yy1v0qk";    // часть вебхука (ключ авторизации)


$urlGet = "https://{$domain}/rest/{$webhook}/crm.deal.get.json?id={$dealID}";

$zaprosGet = file_get_contents($urlGet);
$jsonDecodeGet = json_decode ($zaprosGet, true);

$title = $jsonDecodeGet ["result"]["TITLE"];
$pais = $jsonDecodeGet ["result"]["UF_CRM_649AF1D374E3B"];

// Меняем ID значений поля в Свич
switch ($pais){
	case 1729:
	$pais = 89;
	break;
	
	case 1731:
	$pais = 91;
	break;
	
	case 1733:
	$pais = 93;
	break;
	
	case 1735:
	$pais = 95;
	break;
}
//Использеум данные в enterprise

$domainENT = "enterprisesubscription.bitrix24.com";  // домен твоего портала Bitrix24
$webhookENT = "17/ej33x1qpsr6kxpry";    // часть вебхука (ключ авторизации)

$fields = [
"fields" => [
  "TITLE" => $title,
  "UF_CRM_68FB3DBAC1C09" => $pais
]
];

$urlAdd = "https://{$domainENT}/rest/{$webhookENT}/crm.deal.add.json";

$paramsENT = [
"http" =>[
"method" => "POST",
"header"=> "Content-Type: application/x-www-form-urlencoded",
"content" => http_build_query ($fields)
]
];

$context = stream_context_create ($paramsENT);
$zaprosAdd = file_get_contents ($urlAdd, false,$context);
$jsDecodeEnt = json_decode ($zaprosAdd);

echo "<pre>";
print_r ($jsDecodeEnt);
echo "</pre>";

?>











