<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php'; // Autoload do Composer
require_once 'src/config/eloquent.php'; // Inicializa o Eloquent

use App\Controllers\RegistroUserController;
use App\Controllers\MensagemController;
use App\Controllers\LoginController;
use App\Models\User;
use App\Models\Message;
use App\Models\Login;

// Instanciação dos Models
$userController = new RegistroUserController(new User());
$messageController = new MensagemController(new Message());
$loginController = new LoginController(new Login());

// Roteamento

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestUri) {
    case '/':
    case '/user.php':
    case '/user':       
        $resultadoUser = $userController->registrarUsuario();
        require_once 'src/view/user.php';
        break;

    case '/mensagem.php':
    case '/mensagem':        
        $resultadoMensagem = $messageController->registrarMensagem();
        require_once 'src/view/mensagem.php';
        break;

    case '/efetuar-login.php':
    case '/efetuar-login':
        $resultadoLogin = [];        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $resultadoLogin = $loginController->efetuarLogin();
            if (isset($resultadoLogin['sucesso'])) {
                header('Location: /mensagem.php');
                exit();
            }
        }
        require_once 'src/view/efetuar-login.php';
        break;

    case '/logout.php':
    case '/logout':
        $loginController->logout();
        break;

    default:
        http_response_code(404);
        echo "Página não encontrada.";
        break;
}