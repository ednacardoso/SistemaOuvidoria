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
        if (empty($titulo) || empty($descricao) || empty($status)) {
            throw new \InvalidArgumentException("Campos obrigatórios não preenchidos.");
        }

        $sql = "INSERT INTO mensagens (titulo, descricao, status, criado_em, atualizado_em) 
                VALUES (:titulo, :descricao, :status, NOW(), NOW())";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute([
                ':titulo' => $titulo,
                ':descricao' => $descricao,
                ':status' => $status
            ]);
            return $result;
        } catch (PDOException $e) {
            error_log("Erro ao criar mensagem: " . $e->getMessage());
            return false;
        }
    }
}