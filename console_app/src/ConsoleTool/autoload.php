<?php

spl_autoload_register(function ($class_name) {
    $fileName = BASE_DIR . '/src/' . str_replace("\\", "/", $class_name) . '.php';
    if (file_exists($fileName)) {
        include $fileName;
    }
});