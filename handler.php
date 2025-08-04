<?php
$title = "создание сделки говорит о том что обработчик работает";

$url = "https://b24-2txbup.bitrix24.com/rest/1/vx7xsiaqsq61bumx/crm.deal.add?"
. "fields[TITLE]=" . urlencode ($title);

file_get_contents ($url);

?>

