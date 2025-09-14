<?php

// В случае выигрыша код передает название Лида и Списочную страну с одного аккаунта на другой
// В финальной стадии лидов первого аккаунта необходимо указать обработчик и лид https://bitrix-scripts.onrender.com?lead_id={{ID}}


$leadID = $_GET['lead_id'] ?? null;


$leadGet = "https://laempresa.bitrix24.es/rest/1/l0fvjh738yy1v0qk/crm.lead.get.json?"
. "id=" . urlencode($leadID);

$leadgetRun = file_get_contents ($leadGet);
$jsDataLead = json_decode ($leadgetRun,true);
$country = $jsDataLead["result"]["UF_CRM_1687251842328"]; // получили значение страны
$title = $jsDataLead["result"]["TITLE"]; // получили название лида
$mail = $jsDataLead ["result"]["EMAIL"][0]["VALUE"]; // получаем рабочую почту

// в switch меняем id значение полей чтобы в новомм аккаунте появилось нужное значение 
switch($country){
	case 1721:
	$country = 57;
	break;
	case 1723:
	$country =  59;
	break;
	case 1725:
	$country =  61;
	break;
	case 1727:
	$country =  63;
	break;
}



$urlleadCreate = "https://enterprisesubscription.bitrix24.com/rest/17/ej33x1qpsr6kxpry/crm.lead.add.json?"
. "fields[TITLE]=". urlencode($title) // передали название
. "&fields[UF_CRM_1754813532364]=" . urlencode($country) // передали id значение страны которое отобразится как старна в поле
. ."&fields[EMAIL][0][VALUE]=" .urlencode ($mail);

file_get_contents ($urlleadCreate);
?>










