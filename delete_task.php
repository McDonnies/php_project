<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/TaskGateway.php';

use App\Database;
use App\TaskGateway;

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id) {
    $database = new Database();
    $db = $database->getConnection();

    $gateway = new TaskGateway($db);
    $gateway->delete($id);
}

// Уходим обратно
redirect('index.php');