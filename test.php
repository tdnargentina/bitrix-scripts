<?php

require 'rest.php';

$result = callRest('user.current');

echo '<pre>';
print_r($result);
?>
