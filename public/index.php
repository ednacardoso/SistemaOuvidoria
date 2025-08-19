<?php
chdir(dirname(__DIR__));
session_start();

require_once 'vendor/autoload.php'; 
require_once 'src/config/eloquent.php'; 

use App\control\RegistroUserController;
use App\control\MensagemController;
use App\control\LoginController;
use App\model\User;
use App\model\Message;
use App\model\Login;


$userController = new RegistroUserController(new User());
$messageController = new MensagemController(new Message());
$loginController = new LoginController(new Login());


$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestUri) {
    case '/':
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

    case '/logout.php':
    case '/logout':
        $loginController->logout();
        break;

    default:
        http_response_code(404);
        echo "Página não encontrada.";
        break;
}
