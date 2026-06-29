<?php

function callRest($method, array $fields = [])
{
    $auth = json_decode(file_get_contents(__DIR__.'/auth.json'), true);

    $url = "https://{$auth['DOMAIN']}/rest/{$method}.json";

    $fields['auth'] = $auth['AUTH_ID'];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($fields)
        ]
    ];

    $context = stream_context_create($options);

    return json_decode(
        file_get_contents($url, false, $context),
        true
    );
}
?>
