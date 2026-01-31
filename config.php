<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
const ROOT_DIR = __DIR__ . '/php_project';
const INCLUDES_DIR = ROOT_DIR . '/includes';
const DATA_DIR = ROOT_DIR . '/data';
const TASKS_FILE = DATA_DIR . '/tasks.json';

// ...
const ALLOWED_STATUSES = [
    'Новая' => 'primary',
    'В работе' => 'warning',
    'Выполнена' => 'success',
];
