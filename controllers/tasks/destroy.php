<?php
require_once basePath('includes/header.php');
require_once basePath('TaskGateway.php');

use core\Database;

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id) {
    $database = new Database();
    $db = $database->getConnection();

    $gateway = new TaskGateway($db);
    $gateway->delete($id);
}

redirect('/');