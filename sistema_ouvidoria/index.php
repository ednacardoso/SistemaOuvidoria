<?php
session_start();
require_once 'src/config/database.php';
require_once 'src/model/User.php';
require_once 'src/model/Message.php';
require_once 'src/model/Login.php';
require_once 'src/control/OuvidoriaController.php';

use App\Controllers\OuvidoriaController;

// Conexão com o banco de dados
$pdo = getConnection();
$controller = new OuvidoriaController($pdo);

// Roteamento

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Rota para página de cadastro de usuário
if ($requestUri === '/' || $requestUri === '/user' || $requestUri === '/user.php') 
    {
    $resultadoUser = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $resultadoUser = $controller->registrarUsuario();
    }
    require_once 'src/view/user.php';
}
// Rota para processar o cadastro de usuário
elseif ($requestUri === '/registrar-usuario' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultadoUser = $controller->registrarUsuario();
    require_once 'src/view/user.php';
}
// Rota para página de envio de mensagem
elseif ($requestUri === '/mensagem.php') 
    {
    $resultadoMensagem = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $resultadoMensagem = $controller->registrarMensagem();
    }
    require_once 'src/view/mensagem.php';
}
// Rota para processar o envio de mensagem
elseif ($requestUri === '/registrar-mensagem' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultadoMensagem = $controller->registrarMensagem();
    require_once 'src/view/mensagem.php';
}
elseif ($requestUri === '/efetuar-login.php' || $requestUri === '/efetuar-login') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $resultadoLogin = $controller->efetuarLogin();
        if (isset($resultadoLogin['sucesso'])) {
            header('Location: /mensagem.php');
            exit();
        }
    }
    require_once 'src/view/efetuar-login.php';
}
// Página não encontrada
else {
    http_response_code(404);
    echo "Página não encontrada.";
}