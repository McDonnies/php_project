<?php require_once __DIR__ . '/includes/config.php'; ?>
<?php require_once INCLUDES_DIR.'/functions.php'; ?>
<?php require_once INCLUDES_DIR.'/header.php'; ?>
<?php
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';
$status = $_POST['status'] ?? "Новая задача";

if ($title === '') {
    $_SESSION['old_data'] = [
        'status' => $status,
        'title' => $title,
        'description' => $description,
    ];
    header('Location: create.php?error=empty');
    exit;
}
if (taskExists($title)) {
    $_SESSION['old_data'] = [
        'status' => $status,
        'title' => $title,
        'description' => $description,
    ];
    header('Location: create.php?error=duplicate');
    exit;
}
addTask($title, $description, $status);
header('Location: index.php?success=1');
exit;


