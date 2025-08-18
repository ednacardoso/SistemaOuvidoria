<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Login;
use PDO;

class RegistroMensagemController {
    private $userModel;
    private $messageModel;
    private $loginModel;

    public function __construct(User $userModel, Message $messageModel, Login $loginModel) {
        $this->userModel = $userModel;
        $this->messageModel = $messageModel;
        $this->loginModel = $loginModel;
    }

    public function registrarUsuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $nome = $_POST['nome'] ?? '';
                $email = $_POST['email'] ?? '';
                $cpf = $_POST['cpf'] ?? '';
                $senha = $_POST['senha'] ?? '';
                $telefone = $_POST['telefone'] ?? null;

                $result = User::createUser($nome, $email, $cpf, $senha, $telefone);
                // O model retorna false em caso de PDOException (ex: e-mail/cpf duplicado)
                return $result
                    ? ['sucesso' => 'Usuário cadastrado com sucesso!']
                    : ['erro' => 'Erro ao cadastrar usuário. O e-mail ou CPF pode já estar em uso.'];
            } catch (\InvalidArgumentException $e) {
                return ['erro' => $e->getMessage()];
            }
        }
        return [];
    }

    public function registrarMensagem() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $titulo = $_POST['titulo'] ?? '';
                $descricao = $_POST['descricao'] ?? '';
                $status = $_POST['status'] ?? 'Pendente';

                $result = Message::createMessage($titulo, $descricao, $status);
                return $result ? ['sucesso' => 'Mensagem enviada com sucesso!'] : ['erro' => 'Erro ao enviar mensagem.'];
            } catch (\InvalidArgumentException $e) {
                return ['erro' => $e->getMessage()];
            }
        }
        return [];
    }

    
}    