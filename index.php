<?php require_once __DIR__ . '/includes/config.php'; ?>
<?php require_once INCLUDES_DIR.'/functions.php'; ?>
<?php require_once INCLUDES_DIR.'/header.php'; ?>

<?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Ура!</strong> Задача успешно создана.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if (isset($_GET['error']) && $_GET['error'] === 'not_found'): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Ошибка!</strong> Запрашиваемая задача не найдена.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
    <div class ="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Список задач</h1>
        <a href="create.php" class="btn btn-primary btn-sm">
            + Новая задача
        </a>
    </div>
    <div class="list-group">
        <?php
        $tasks = getTasks();
        foreach ($tasks as $task):
            $safe_id = e($task['id']);
            $safe_title = e($task['title']);
            $safe_status = e($task['status']);

            $color = getStatusColor($task['status']);
            ?>
    <a href="task.php?id=<?= $safe_id ?>"
       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        <span class="fw-bold"><?= $safe_title ?></span>
        <span class="badge bg-<?= $color ?>"> <?= $safe_status ?></span>
    </a>
        <?php endforeach; ?>
    </div>
<?php require_once INCLUDES_DIR.'/footer.php'; ?>