<?php
namespace App\Repository;

use App\Model\User;
use App\Core\Database;

// This class handles database operations related to User entities.

class UserRepository {
    private \PDO $pdo;

    public function __construct(Database $database) {
        $this->pdo = $database->getPdo();
    }

    public function findByEmail(string $email): ?User {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$data) return null;

        $user = new User($data['name'], $data['email'], '');
        $user->id = $data['id'];
        $user->password = $data['password'];
        return $user;
    }

    public function save(User $user): void {
        $stmt = $this->pdo->prepare(
            "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
        );
        $stmt->execute([$user->name, $user->email, $user->password]);
    }
}