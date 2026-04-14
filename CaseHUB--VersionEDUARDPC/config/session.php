<?php

function caseHubSessionCookieParams(int $lifetime = 0): array
{
    return [
        'lifetime' => $lifetime,
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax',
    ];
}

function caseHubCookieOptions(int $lifetime = 0): array
{
    return [
        'expires' => $lifetime > 0 ? time() + $lifetime : 0,
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax',
    ];
}

function caseHubRememberSecret(): string
{
    return 'casehub_remember_secret_2026';
}

function startSession(bool $rememberUser = false): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    $sessionPath = __DIR__ . '/../storage/sessions';

    if (!is_dir($sessionPath)) {
        mkdir($sessionPath, 0777, true);
    }

    session_name('CASEHUBSESSID');
    session_save_path($sessionPath);

    session_set_cookie_params(caseHubSessionCookieParams($rememberUser ? 60 * 60 * 24 * 30 : 0));

    ini_set('session.use_only_cookies', '1');
    ini_set('session.use_strict_mode', '1');
    session_start();
}
