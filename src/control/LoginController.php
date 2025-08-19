<?php
namespace App\control;

use App\model\User;
use App\model\Message;
use App\model\Login;
use PDO;

class LoginController {
    private $loginModel;

    public function __construct(Login $loginModel) {
        $this->loginModel = $loginModel;
    }    

    public function efetuarLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $email = $_POST['email'] ?? '';
                $senha = $_POST['senha'] ?? '';
                if ($this->loginModel->authenticate($email, $senha)) {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['email'] = $email;
                    return ['sucesso' => 'Login efetuado com sucesso'];
                }
                return ['erro' => 'Credenciais inválidas'];
            } catch (\InvalidArgumentException $e) {
                return ['erro' => $e->getMessage()];
            }
        }
        return [];
    }

    public function logout() {
        // Limpa todas as variáveis de sessão
        $_SESSION = [];
        // Destrói a sessão
        session_destroy();
        // Redireciona para a página de login
        header('Location: /efetuar-login.php');
        exit();
    }
}
