<?php

$input = file_get_contents('php://input');
error_log("Webhook received: " . $input);
echo json_encode(["result" => "ok"]);


?>


