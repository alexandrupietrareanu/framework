<?php

declare(strict_types=1);

namespace Adapters\Persistence;

class PostgresRepository
{
    public function __construct(private Connection $connection) {}

    /**
     * @return null|array<class-string>
     */
    public function findById(string $table, int $id): ?array
    {
        $pdo = $this->connection::get();
        $stmt = $pdo->prepare("SELECT * FROM {$table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();

        return $result ?: null;
    }

    /**
     * @param array<string, null|float|int|string> $data
     */
    public function save(string $table, array $data): void
    {
        $pdo = $this->connection::get();

        if (empty($data['id'])) {
            unset($data['id']);
            $fields = implode(', ', array_keys($data));
            $placeholders = implode(', ', array_map(fn ($key) => ":{$key}", array_keys($data)));

            $stmt = $pdo->prepare("INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})");
            $stmt->execute($data);
        } else {
            // Update existing record
            $stmt = $pdo->prepare("UPDATE {$table} SET name=:name, price=:price WHERE id=:id");
            $stmt->execute($data);
        }
    }

    // Helper method to retrieve last inserted ID
    public function getLastInsertedId(string $table): int
    {
        $pdo = $this->connection::get();
        $stmt = $pdo->query("SELECT currval(pg_get_serial_sequence('{$table}','id'))");

        if (!$stmt instanceof \PDOStatement) {
            throw new \PDOException('Database not available');
        }

        return (int) $stmt->fetchColumn();
    }
}
