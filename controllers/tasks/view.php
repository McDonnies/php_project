<?php

use core\Database;
use core\Response;

require_once basePath('includes/header.php');
require_once basePath('TaskGateway.php');

$current_id = (int)($_GET['id'] ?? 0);
$database = new Database();
$db = $database->getConnection();
$gateway = new TaskGateway($db);

$task = $gateway->getById($current_id);

if (! $task) {
    abort(Response::NOT_FOUND);
}

    $title = e($task['title']);
    $description = e($task['description']);
    $status = e($task['status']);
    $color = getStatusColor($task['status']);
?>
        <div class="card shadow-sm">
            <div class="card-header">
                <h1 class = "h3"><?=$title?></h1>
            </div>
            <div class="card-body">
                <p>
                    <strong>Status:</strong>
                    <span class = "badge bg-<?=$color?>">
                        <?=$status?>
                    </span>
                </p>
                <p class="card-text"> <?= $description ?></p>
                <a href="/" class="btn btn-primary mt-3">Back to the list</a>
            </div>
        </div>

<?php require_once basePath('includes/footer.php'); ?>
