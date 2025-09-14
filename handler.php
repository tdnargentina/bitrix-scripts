
<?php

// получааем данные id того лида который хотим передать
$laEmpresaLeadID =//$_GET ["lead_id"] ?? null;
// создаем хапрос на получания данных по id лида
$urlLeadGet = "https://laempresa.bitrix24.es/rest/1/l0fvjh738yy1v0qk/crm.lead.get.json?"
."id=". urlencode($laEmpresaLeadID);
// получаем результат запроса
$getResult = file_get_contents($urlLeadGet);
//декодируем результат и получаем нужные данные в полях
$decodeResult = json_decode ($getResult, true);
$title = $decodeResult ["result"]["TITLE"]; 
$mail = $decodeResult ["result"]["EMAIL"][0]["VALUE"];

// создаем лид на другом аккаунте

$entLeadAdd = "https://enterprisesubscription.bitrix24.com/rest/17/ej33x1qpsr6kxpry/crm.lead.add.json?"
."fields[TITLE]=" .urlencode ($title)
."&fields[EMAIL][0][VALUE]=" .urlencode ($mail);

$result = file_get_contents($entLeadAdd);
?>










