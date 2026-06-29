<?php

file_put_contents(
    __DIR__.'/install.log',
    print_r($_REQUEST, true)
);

echo 'OK';
?>
