<?php

// Получае данные сделки
$dealdata = $_POST ["data"]["FIELDS"]["ID"];

//Добавляем полученные данные в файл
$file = "test.txt";
file_put_contents ($file,$dealdata);

// Создаем переменные для передачи значений
$title = "Выяснить причину удаления сделки";
$description = "Была удалена сделка ID: $dealdata пожалуйста посмотрите кто удалил и выясните причину";
$resoinsible = 1;
$deadline = "2025/07/13";

// Задаем юрл для запуска задачи
$url = "https://laempresa.bitrix24.es/rest/1/luufo23s7kq9k433/task.item.add.json?"
. "fields[TITLE]=" . urlencode($title)
. "&fields[DESCRIPTION]=" . urlencode ($description)
. "&fields[RESPONSIBLE_ID]=" . urlencode ($resoinsible)
. "&fields[DEADLINE]=" . urlencode($deadline);

// Запускаем ЮРЛ
file_get_contents ($url);




?>
