<?php

$data = [
    'DOMAIN'      => $_REQUEST['DOMAIN'] ?? '',
    'AUTH_ID'     => $_REQUEST['AUTH_ID'] ?? '',
    'REFRESH_ID'  => $_REQUEST['REFRESH_ID'] ?? '',
    'SERVER_ENDPOINT' => $_REQUEST['SERVER_ENDPOINT'] ?? '',
    'AUTH_EXPIRES' => time() + ($_REQUEST['AUTH_EXPIRES'] ?? 3600)
];

file_put_contents(
    __DIR__.'/auth.json',
    json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

echo "Приложение успешно установлено";
?>
