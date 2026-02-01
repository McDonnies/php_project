<?php

use core\Database;
use core\Validator;

require_once basePath('includes/header.php');
require_once basePath('TaskGateway.php');


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $status = $_POST['status'];
    $errors = array();
    if (! Validator::string($title,1,255)) {
        $errors['title'] = 'Task title is required and cannot be empty.';
    }
    if (! Validator::string($description, 1, 1000)) {
        $errors['description'] = 'Description is required.';
    }
    if (! empty($errors)) {
        redirect('/create?error=empty_fields');
    }
    $database = new Database();
    $db = $database->getConnection();
    $gateway = new TaskGateway($db);
    try {
        $gateway->create($title, $description, $status);
        redirect('/?success=1');
    } catch (PDOException $e) {
        // Error code 1062 "Duplicate entry"
        if ($e->errorInfo[1] === 1062) {
            redirect('/create?error=duplicate');
        } else {
            // If it's another error, throw it further
            throw $e;
        }
    }
}

redirect('/create');