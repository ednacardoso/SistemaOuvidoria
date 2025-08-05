<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Login;
use PDO;

class OuvidoriaController {
    private $pdo;
    private $userModel;
    private $messageModel;
    private $loginModel;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
        $this->messageModel = new Message($pdo);
        $this->loginModel = new Login($pdo); // Add this line
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

    public function efetuarLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';   
            $result = $this->loginModel->authenticate($email, $senha);

            if ($result) {
                $_SESSION['logged_in'] = true;
                $_SESSION['email'] = $email;
                return ['sucesso' => 'Login efetuado com sucesso'];
            }
            return ['erro' => 'Credenciais inválidas'];
        }
        return [];
    }
}    