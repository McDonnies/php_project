<?php require_once __DIR__ . '/includes/config.php'; ?>
<?php require_once INCLUDES_DIR.'/functions.php'; ?>
<?php require_once INCLUDES_DIR.'/header.php'; ?>
<?php
$current_id = (int)($_GET['id'] ?? 0);
$task = getTask($current_id);

if ($task === null) {
    header('Location: index.php?error=not_found');
    exit;
}

if ($task):
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
    <?php else: ?>
        <div class="alert alert-danger">
            <h1 class = "alert-heading h3">Задача не найдена</h1>
            <p>Задача с ID <?= $current_id?> не существует</p>
            <a href = "index.php" class="btn btn-danger">Назад к списку</a>
        </div>
    <?php endif; ?>
<?php require_once INCLUDES_DIR.'/footer.php'; ?>
