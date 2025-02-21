<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Message;
use PDO;

class OuvidoriaController {
    private $pdo;
    private $userModel;
    private $messageModel;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
        $this->messageModel = new Message($pdo);
    }

    public function registrarUsuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $cpf = $_POST['cpf'] ?? '';
            $senha = $_POST['senha'] ?? '';
            $telefone = $_POST['telefone'] ?? null;

            $result = $this->userModel->create($nome, $email, $cpf, $senha, $telefone);
            return $result ? ['sucesso' => 'Usuário cadastrado com sucesso!'] : ['erro' => 'Erro ao cadastrar usuário.'];
        }
        return [];
    }

    public function registrarMensagem() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? '';
            $descricao = $_POST['descricao'] ?? '';
            $status = $_POST['status'] ?? 'Pendente';

            $result = $this->messageModel->create($titulo, $descricao, $status);
            return $result ? ['sucesso' => 'Mensagem enviada com sucesso!'] : ['erro' => 'Erro ao enviar mensagem.'];
        }
        return [];
    }
}