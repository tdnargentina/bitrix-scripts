<?php

function callRest($method, array $fields = [])
{
    $auth = json_decode(file_get_contents(__DIR__.'/auth.json'), true);

    $url = "https://{$auth['DOMAIN']}/rest/{$method}.json?auth=".$auth['AUTH_ID'];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($fields),
            'ignore_errors' => true
        ]
    ];

    $context = stream_context_create($options);

    $result = file_get_contents($url, false, $context);

    return json_decode($result, true);
}
?>
