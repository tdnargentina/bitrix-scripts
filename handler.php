<?php
$leadID = $_GET['lead_id'] ?? null;

$url = "https://enterprisesubscription.bitrix24.com/rest/17/ej33x1qpsr6kxpry/crm.lead.add.json?"
. "fields[TITLE]=". urlencode($leadID);

file_get_contents ($url);
?>



