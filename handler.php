<?php

// Получае данные сделки
$dealdata = $_POST ["data"]["FIELDS"]["ID"];

// Создаем переменные для передачи значений
$title = "Выяснить причину удаления сделки $dealdata";
$description = "Была удалена сделка ID: $dealdata пожалуйста, перейдите в корзину и посмотрите кто удалил и выясните причину удаления (задача созданна данным вебхуком https://enterprisesubscription.bitrix24.com/devops/edit/out-hook/19/)";
$resoinsible = 17;
$deadline = "2025/07/30";

// Задаем юрл для запуска задачи
$url = "https://enterprisesubscription.bitrix24.com/rest/17/n5yegmmn5ob395jp/task.item.add.json?"
. "fields[TITLE]=" . urlencode($title)
. "&fields[DESCRIPTION]=" . urlencode ($description)
. "&fields[RESPONSIBLE_ID]=" . urlencode ($resoinsible)
. "&fields[DEADLINE]=" . urlencode($deadline);
// Запускаем ЮРЛ
file_get_contents ($url);

?>
