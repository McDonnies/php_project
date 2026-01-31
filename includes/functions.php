<?php

use JetBrains\PhpStorm\NoReturn;

function e(string $text): string {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
#[NoReturn]
function redirect(string $path): void
{
    header("Location: $path");
    exit;
}

function getStatusColor(string $status): string {
    return ALLOWED_STATUSES[$status] ?? 'secondary';
}

function basePath(string $path): string{
    return BASE_PATH . $path;
}