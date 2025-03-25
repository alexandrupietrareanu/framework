<?php

declare(strict_types=1);

namespace Adapters\Persistence;

class Connection
{
    private static ?\PDO $pdo = null;

    public static function get(): \PDO
    {
        if (!self::$pdo) {
            $dsn = 'pgsql:host=db;port=5432;dbname=appdb';
            $username = 'appuser';
            $password = 'secret';

            self::$pdo = new \PDO($dsn, $username, $password, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            ]);
        }

        return self::$pdo;
    }
}
