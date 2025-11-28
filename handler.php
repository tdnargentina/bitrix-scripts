<?php
/*
В исходящий вебхук необходимо поставить событие onCrmDynamicItemAdd
В методе нужно указать crm.item.update
Документация:
https://apidocs.bitrix24.ru/api-reference/crm/universal/events/on-crm-dynamic-item-add.html
https://apidocs.bitrix24.ru/api-reference/crm/universal/crm-item-update.html
Обработчик вызывается при создании элемента смарт-процесса (SPA).
Его задача — изменить ответственного и название созданного элемента.
*/
// ---- 1. Настройки подключения к Bitrix24 ----
$domain = "laempresa.bitrix24.es";         // Домен портала Bitrix24
$webhook = "1/hloshe3nj97bypps";           // Ключ вебхука (аутентификация)

// ---- 2. Получение данных, которые передал Bitrix24 ----
// Bitrix при событии onCrmDynamicItemAdd отправляет form-data, поэтому читаем $_POST.
$spaId = $_POST["data"]["FIELDS"]["ID"];               // ID созданного элемента SPA
$entityTypeId = $_POST["data"]["FIELDS"]["ENTITY_TYPE_ID"]; // Тип сущности SPA (entityTypeId)


// получаем поля созданного элемента

$urlGet = "https://{$domain}/rest/{$webhook}/crm.item.get.json?entityTypeId={$entityTypeId}&id={$spaId}";

$zapuskGet = file_get_contents ($urlGet);
$getDecode = json_decode ($zapuskGet, true);
$string = $getDecode["result"]["item"]["ufCrm19_1723554092730"]; // данные по id сотрудника


// ---- 3. Формируем данные, которые хотим изменить у элемента SPA ----
$title = "SPA с новым ответственным REST API";   // Новое название элемента
$responsible = null;                                // Новый ответственный (ID пользователя)

switch ($string) {
	case 1:
	$responsible = 1;
	break;
	case 6:
	$responsible = 6;
	break;
	case 29:
	$responsible = 29;
	break;
}


// Поля, которые будем обновлять в элементе
$fields = [
    "title" => $title,             // Поле TITLE в smart-процессах — camelCase
    "assignedById" => $responsible // Назначение ответственного
];

// ---- 4. Формируем параметры запроса для метода crm.item.update ----
$params = [
    "entityTypeId" => $entityTypeId, // Тип смарт-процесса
    "id" => $spaId,                   // ID элемента
    "fields" => $fields               // Какие поля обновляем
];

// ---- 5. Готовим URL к REST API Bitrix24 ----
$url = "https://{$domain}/rest/{$webhook}/crm.item.update.json";

// ---- 6. Подготовка HTTP-запроса ----
// Bitrix ожидает данные в формате x-www-form-urlencoded, используем http_build_query.
$settings = [
    "http" => [
        "method"  => "POST",                                // Метод запроса
        "header"  => "Content-Type: application/x-www-form-urlencoded",
        "content" => http_build_query($params)              // Тело запроса
    ]
];

// ---- 7. Создаем контекст HTTP-запроса ----
$context = stream_context_create($settings);

// ---- 8. Отправляем запрос в Bitrix24 ----
$zapusk = file_get_contents($url, false, $context);



//"UF_CRM_19_1723554092730"

?>

