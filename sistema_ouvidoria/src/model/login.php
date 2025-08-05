<?php
namespace App\Models;

use PDO;
use PDOException;

class Login {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function authenticate(string $email, string $senha): bool {
        if (empty($email) || empty($senha)) {
            throw new \InvalidArgumentException("Campos obrigatórios não preenchidos.");
        }

        $sql = "SELECT senha FROM usuarios WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($senha, $user['senha'])) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Erro ao autenticar usuário: " . $e->getMessage());
            return false;
        }
    }
}
