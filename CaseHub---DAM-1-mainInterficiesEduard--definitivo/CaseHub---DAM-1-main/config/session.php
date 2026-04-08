<?php

function startAppSession(bool $rememberUser = false): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    $sessionPath = __DIR__ . '/../storage/sessions';

    if (!is_dir($sessionPath)) {
        mkdir($sessionPath, 0777, true);
    }

    session_save_path($sessionPath);

    session_set_cookie_params([
        'lifetime' => $rememberUser ? 60 * 60 * 24 * 30 : 0,
        'path' => '/',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);

    session_start();
}
