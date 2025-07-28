<?php
// Получае данные сделки
$dealdata = $_POST ["data"]["FIELDS"]["ID"];

// получаем данные сделки с аккаунта 1

$urlDealGet = "https://laempresa.bitrix24.es/rest/1/a9wyp5ll5h14nuzm/crm.deal.get.json?ID=$dealdata";
$dealdata = file_get_contents ($urlDealGet);
$dealJS = json_decode($dealdata, true);

$title = $dealJS["result"]["TITLE"];
$listaABC = $dealJS ["result"]["UF_CRM_1684250117415"];

switch ($listaABC){
	case 1701:
	$listaABC = 45;
	break;
	case 1703:
	$listaABC = 47;
	break;
	case 1705:
	$listaABC = 49;
	break;
}

// Создаем сделку на Энт

$urlDealAdd = "https://enterprisesubscription.bitrix24.com/rest/17/n5yegmmn5ob395jp/crm.deal.add.json?"
."fields[TITLE]=". urlencode($title)
."&fields[UF_CRM_1750495914815]=" . urlencode($listaABC);
file_get_contents ($urlDealAdd);
?>
