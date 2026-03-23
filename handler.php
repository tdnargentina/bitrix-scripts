<?php
// Домен  Битрикс24
$domain  = 'aaavito.bitrix24.ru';

// Вебхук  портала
$webhook = '1/nthi0g5a4kz8biro/';

$date = date('Y-m-d H:i:s', strtotime('-14 days'));

$params24 = [
    'filter' => [
        '=STATUS_ID' => 'NEW',
		'<DATE_MODIFY' => $date,
    ],
    'select' => ['ID', 'TITLE', 'DATE_MODIFY']
];


$urlList = "https://{$domain}/rest/{$webhook}/crm.lead.list.json";

$settingList = [
'http' => [
'method' => 'POST',
'header' => 'Content-Type: application/x-www-form-urlencoded', 
'content' => http_build_query ($params24),
]
];

$contextList = stream_context_create($settingList);
$zapuskList = file_get_contents ($urlList, false, $contextList);
$resultList = json_decode ($zapuskList,true);
$Vivod = print_r ($resultList, true);

if (empty($resultList['result'])) {
    echo "Нет забытых лидов";
    exit;
}
// СОЗДАЕМ ЗАДАЧУ

$urlTask = "https://{$domain}/rest/{$webhook}/tasks.task.add.json";

$taskFields = [
'fields' =>[
'TITLE' => 'Обнаружены забытые лиды',
'DESCRIPTION' => $Vivod,
'RESPONSIBLE_ID' => 16,
]
];

$settingTask = [
'http' => [
'method' => 'POST',
'header' => 'Content-Type: application/x-www-form-urlencoded', 
'content' => http_build_query ($taskFields),
]
];
$contextTask = stream_context_create($settingTask);
$zapuskTask = file_get_contents ($urlTask, false, $contextTask);
$resultTask = json_decode ($zapuskTask,true);

echo "<pre>";
print_r($resultTask);
echo "</pre>";

?>





