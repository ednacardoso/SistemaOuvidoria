<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Login;
use PDO;

class RegistroUserController {
    private $userModel;

    public function __construct(User $userModel) {
        $this->userModel = $userModel;
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
                return $result
                    ? ['sucesso' => 'Usuário cadastrado com sucesso!']
                    : ['erro' => 'Erro ao cadastrar usuário. O e-mail ou CPF pode já estar em uso.'];
            } catch (\InvalidArgumentException $e) {
                return ['erro' => $e->getMessage()];
            }
        }
        return [];
    }
   
}    