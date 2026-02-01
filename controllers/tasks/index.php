<?php

use core\Database;

require_once basePath('includes/header.php');
require_once basePath('TaskGateway.php');
$database = new Database();
$db = $database->getConnection();

$gateway = new TaskGateway($db);
$tasks = $gateway->getAll();
if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Task created.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if (isset($_GET['error']) && $_GET['error'] === 'not_found'): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Task not found.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
    <div class ="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Task list</h1>
        <a href="/create" class="btn btn-primary btn-sm">
            + New task
        </a>
    </div>
    <div class="list-group">
    <?php

    foreach ($tasks as $task):
        $safe_id = e($task['id']);
        $safe_title = e($task['title']);
        $safe_status = e($task['status']);
        $text_style = ($task['status'] === 'done') ? 'text-decoration-line-through text-muted' : 'fw-bold';
        $btn_class = ($task['status'] === 'done') ? 'btn btn-success' : 'btn btn-danger';
        $icon_class = ($task['status'] === 'done') ? 'bi-check-lg' : 'bi-circle';
        $color = getStatusColor($task['status']);
        ?>
        <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center flex-grow-1">
                <a href="/task/toggle?id=<?= $safe_id ?>"
                   class="btn <?= $btn_class ?> btn-sm me-3 d-flex align-items-center justify-content-center"
                   style="width: 32px; height: 32px; border-radius: 50%;">
                    <i class="bi <?= $icon_class ?>"></i>
                </a>

                <a href="/task?id=<?= $safe_id ?>" class="text-decoration-none text-dark flex-grow-1">
                    <span class="<?= $text_style ?>"><?= $safe_title ?></span>
                </a>
            </div>

            <a href="/task/destroy?id=<?= $safe_id ?>"
               class="btn btn-outline-danger btn-sm ms-2"
               onclick="return confirm('Confirm delete?');">
                <i class="bi bi-trash"></i>
            </a>

        </div>
    <?php endforeach; ?>
    </div>
<?php require_once basePath('includes/footer.php'); ?>
