<?php
use App\Database;
use App\TaskGateway;

require_once basePath('TaskGateway.php');
require_once basePath('Database.php');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    $database = new Database();
    $db = $database->getConnection();
    $gateway = new TaskGateway($db);

    $task = $gateway->getById($id);

    if ($task) {
        $newStatus = ($task['status'] === 'done') ? 'pending' : 'done';
        $gateway->updateStatus($id, $newStatus);
    }
}

redirect('/');