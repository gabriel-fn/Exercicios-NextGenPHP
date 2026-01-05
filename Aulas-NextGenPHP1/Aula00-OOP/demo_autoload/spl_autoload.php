<?php

// spl_autoload_register('autoload2');
spl_autoload_register(function ($className) {
    echo $className;
    exit;
});

new Teste123();
