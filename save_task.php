<?php
require_once __DIR__ . '/includes/config.php';
require_once INCLUDES_DIR.'/functions.php';
require_once INCLUDES_DIR.'/header.php';

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/TaskGateway.php';

use App\Database;
use App\TaskGateway;
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $status = $_POST['status'];
    if (empty($title) || empty($description) || empty($status)) {
        redirect('create.php?error=empty_fields');
    }
    $database = new Database();
    $db = $database->getConnection();
    $gateway = new TaskGateway($db);
    $gateway->create($title, $description, $status);
    redirect('index.php?success=1');
}


redirect('create.php');