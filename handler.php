

<?php

$leadID = $_GET['lead_id'] ?? null;


$leadGet = "https://laempresa.bitrix24.es/rest/1/l0fvjh738yy1v0qk/crm.lead.get.json?"
. "id=" . urlencode($leadID);

$leadgetRun = file_get_contents ($leadGet);
$jsDataLead = json_decode ($leadgetRun,true);
$country = $jsDataLead["result"]["UF_CRM_1687251842328"]; // получили значение страны
$title = $jsDataLead["result"]["TITLE"]; // получили название лида
$employee = $jsDataLead["result"]["UF_CRM_1738672890"]; // получили ID сотрудника
$responsible = $jsDataLead ["result"]["ASSIGNED_BY_ID"]; // получили ID ответственного

// switch для изменения значений поля Страна
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


// switch для изменения значений поля Сотрудник 
switch ($employee){
	case 1:
	$employee = 17;
	break;
	case 6:
	$employee = 15;
	break;
}
// switch для изменения значений поля ответственный

switch ($responsible){
	case 1;
	$responsible = 17;
	break;
	case 6:
	$responsible = 15;
	break;
}

$urlleadCreate = "https://enterprisesubscription.bitrix24.com/rest/17/ej33x1qpsr6kxpry/crm.lead.add.json?"
. "fields[TITLE]=". urlencode($title)
. "&fields[UF_CRM_1754813532364]=" . urlencode($country)
. "&fields[UF_CRM_1755506529]=" . urlencode($employee)
. "&fields[ASSIGNED_BY_ID]=" . urlencode($responsible);

file_get_contents ($urlleadCreate);






