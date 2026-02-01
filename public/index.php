<?php

const BASE_PATH = __DIR__ . '/../';
require_once BASE_PATH . 'includes/functions.php';

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require basePath("$class.php");
});
require_once basePath('config.php');
require_once basePath('router.php');
