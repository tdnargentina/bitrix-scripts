
<?php

$title = "testHook";
$leadGet = "https://laempresa.bitrix24.es/rest/1/l0fvjh738yy1v0qk/crm.lead.add.json?"
. "fields[TITLE]=" . urlencode ($title);

file_get_contents ($leadGet);

?>







