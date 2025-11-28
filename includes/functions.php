<?php
require_once 'config.php';

function getTasks():array {
    if (!file_exists(TASKS_FILE)) {
        return [];
    }
    $json = file_get_contents(TASKS_FILE);
    $tasks = json_decode($json, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('json decode error: ' . json_last_error_msg());
        return [];
    }
    return is_array($tasks) ? $tasks : [];
}

function getTask(int $id): ?array {
    if ($id <= 0) {
        return null;
    }
    $tasks = getTasks();
    foreach ($tasks as $task) {
        if ($task['id'] === $id) {
            return $task;
        }
    }
    return null;
}
function updateTasks(array $tasks): bool {
    if(!is_dir(DATA_DIR)) {
        mkdir(DATA_DIR, 0755, true);
    }
    $json = json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if(json_last_error() !== JSON_ERROR_NONE) {
        error_log('json encode error: ' . json_last_error_msg());
        return false;
    }
    return file_put_contents(TASKS_FILE, $json) !== false;

}
function taskExists(string $title ): bool {
    $tasks = getTasks();
    foreach ($tasks as $task) {
        if ($task['title'] === $title) {
            return true;
        }
    }
    return false;
}

function addTask(string $title , ?string $description = null, ?string $status = null): ?int {
   $tasks = getTasks();

    $max_id = 0;
    foreach ($tasks as $task) {
        if ($task['id'] > $max_id){
            $max_id = $task['id'];
        }
    }
    $new_id = $max_id + 1;
    $new_task = [
        'id' => $new_id,
        'title' => $title,
        'description' => $description ?? '',
        'status' => $status ?? 'Новая'
    ];

    $tasks[$new_id] = $new_task;
    if (updateTasks($tasks)) {
        return $new_id;
    }
    return null;
}

function e(string $text): string {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function getStatusColor(string $status): string {
    return ALLOWED_STATUSES[$status] ?? 'secondary';
}
