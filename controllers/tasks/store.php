<?php
use App\Database;
use App\TaskGateway;
require_once basePath('includes/header.php');
require_once basePath('TaskGateway.php');
require_once basePath('Database.php');

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
    redirect('/?success=1');
}


redirect('/create');