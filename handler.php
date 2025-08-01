<?php
$url = "https://laempresa.bitrix24.es/rest/1/msxclcgydt7lj59k/event.bind.json";

$event = "CATALOG.PRODUCT.ON.ADD";
$handler = "https://bitrix-scripts.onrender.com"; // Твой хендлер на Render

// Массив данных, который передадим в POST-запросе
$postData = [
    'event' => $event,
    'handler' => $handler
];

// Инициализация cURL
$ch = curl_init($url);

// Устанавливаем параметры запроса
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true); // POST-запрос
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData)); // Кодируем массив как form-urlencoded

// Выполняем запрос
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Выводим результат
echo "HTTP Status: $httpCode\n";
echo "Response:\n$response";
?>
