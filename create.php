<?php require_once __DIR__ . '/includes/config.php'; ?>
<?php require_once INCLUDES_DIR.'/functions.php'; ?>
<?php require_once INCLUDES_DIR.'/header.php'; ?>
<?php
$old_title = '';
$old_desc = '';
$old_status = '';
?>
<div class = "container">
    <main>
        <?php
            if (isset($_GET['error'])):
                $old_title = $_SESSION['old_data']['title'] ?? '';
                $old_desc = $_SESSION['old_data']['description'] ?? '';
                $old_status = $_SESSION['old_data']['status'] ?? '';
            unset($_SESSION['old_data']);
        ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php if ($_GET['error'] === 'duplicate'): ?>
        <strong>Ошибка!</strong> Задача с таким названием уже существует.

        <?php elseif ($_GET['error'] === 'empty'): ?>
        <strong>Ошибка!</strong> Задача не может быть создана без названия.

        <?php endif; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
        <section class = "card shadow-sm mb-4">
            <div class = "card-header">
                <h1 class = "h3"> Создать новую задачу </h1>
            </div>
            <div class = "card-body">
                <form action="save_task.php" method="POST">
                    <div class="mb-3"><label for = "taskName" class = "form-label">Название задачи:</label>
                        <input id = "taskName" type = "text" name = "title" class = "form-control" value = "<?= e($old_title)?>" required>

                    </div>

                    <div class="mb-3"><label for = "taskDescription" class = "form-label">Описание:</label>
                        <textarea id="taskDescription" name = "description" class = "form-control" rows="3"><?= e($old_desc)?></textarea>
                    </div>

                    <div class="mb-3"><label for = "taskStatus" class = "form-label">Статус:</label>
                        <select id = "taskStatus" name = "status" class = "form-select">
                            <?php foreach(ALLOWED_STATUSES as $name => $color): ?>
                                <option
                                        value="<?= e($name) ?>"
                                        <?= ($name === $old_status) ? 'selected' : '' ?>
                                >
                                    <?= e($name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class = "d-flex justify-content-center">
                        <a href="index.php" class="btn btn-outline-secondary">Отмена</a>
                        <button type="submit" class = "btn btn-primary">Отправить</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</div>


<?php require_once INCLUDES_DIR.'/footer.php'; ?>


