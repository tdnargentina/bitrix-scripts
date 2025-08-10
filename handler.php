<?php
$leadID = $_GET['lead_id'] ?? null;


$leadGet = "https://laempresa.bitrix24.es/rest/1/l0fvjh738yy1v0qk/crm.lead.get.json?"
. "fields[ID]=" . urlencode($leadID);

$leadgetRun = file_get_contents ($leadGet);
$jsDataLead = json_decode ($leadgetRun,true);
$country = $jsDataLead["result"]["UF_CRM_1687251842328"]; // получили значение страны



$urlleadCreate = "https://enterprisesubscription.bitrix24.com/rest/17/ej33x1qpsr6kxpry/crm.lead.add.json?"
. "fields[TITLE]=". urlencode($country);

file_get_contents ($url);
?>





