<?php
$input = file_get_contents("php://input");
error_log("RAW INPUT: " . $input); // <-- увидеть в Render Logs
echo $input; // <-- увидеть в Bitrix журнале
exit;


?>





