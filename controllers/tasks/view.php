<?php
use App\Database;
use App\TaskGateway;

require_once basePath('includes/header.php');
require_once basePath('TaskGateway.php');
require_once basePath('Database.php');

$current_id = (int)($_GET['id'] ?? 0);
$database = new Database();
$db = $database->getConnection();
$gateway = new TaskGateway($db);

$task = $gateway->getById($current_id);

if ($task === null) {
    redirect('/error/not_found');
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
                    <strong>Статус:</strong>
                    <span class = "badge bg-<?=$color?>">
                        <?=$status?>
                    </span>
                </p>
                <p class="card-text"> <?= $description ?></p>
                <a href="/" class="btn btn-primary mt-3">Back to the list.</a>
            </div>
        </div>

<?php require_once basePath('includes/footer.php'); ?>
