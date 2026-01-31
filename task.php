<?php require_once __DIR__ . '/includes/config.php';
require_once INCLUDES_DIR.'/functions.php';
require_once INCLUDES_DIR.'/header.php';
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/TaskGateway.php';

use App\Database;
use App\TaskGateway;
$current_id = (int)($_GET['id'] ?? 0);
$database = new Database();
$db = $database->getConnection();
$gateway = new TaskGateway($db);

$task = $gateway->getById($current_id);

if ($task === null) {
    header('Location: index.php?error=not_found');
    exit;
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
                <a href="index.php" class="btn btn-primary mt-3">Назад к списку</a>
            </div>
        </div>

<?php require_once INCLUDES_DIR.'/footer.php'; ?>
