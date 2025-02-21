<?php
namespace App\Models;

use PDO;
use PDOException;

class User {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function create(string $nome, string $email, string $cpf, string $senha, ?string $telefone = null): bool {
        if (empty($nome) || empty($email) || empty($cpf) || empty($senha)) {
            throw new \InvalidArgumentException("Campos obrigatórios não preenchidos.");
        }

        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (nome, email, cpf, senha, telefone) 
                VALUES (:nome, :email, :cpf, :senha, :telefone)";
        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':cpf' => $cpf,
                ':senha' => $senhaHash,
                ':telefone' => $telefone
            ]);
            return true;
        } catch (PDOException $e) {
            // Em produção, logar o erro em vez de exibir
            error_log("Erro ao criar usuário: " . $e->getMessage());
            return false;
        }
    }
}