<?php

declare(strict_types=1);

namespace config;

return [
    'dsn'  => sprintf(
        'pgsql:host=%s;dbname=%s',
        $_ENV['DB_HOST'] ?: 'localhost',
        $_ENV['DB_NAME'] ?: 'myapp'
    ),
    'user' => $_ENV['DB_USER'] ?: 'username',
    'pass' => $_ENV['DB_PASS'] ?: 'password',
];