<?php
namespace App\Models;

use PDO;
use PDOException;

class Message {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function create(string $titulo, string $descricao, string $status): bool {
        if (empty($titulo) || empty($descricao)) {
            throw new \InvalidArgumentException("Campos obrigatórios não preenchidos.");
        }

        $sql = "INSERT INTO mensagens (titulo, descricao, status) 
                VALUES (:titulo, :descricao, :status)";
        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute([
                ':titulo' => $titulo,
                ':descricao' => $descricao,
                ':status' => $status
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao criar mensagem: " . $e->getMessage());
            return false;
        }
    }
}