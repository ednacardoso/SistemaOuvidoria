<?php
require 'vendor/autoload.php';
$config = require 'config/database.php';
$pdo = new PDO("mysql:host={$config['host']};dbname={$config['ouvidoria']}", $config['postgres'], $config['1a2badmin#$#']);

use App\Controllers\OuvidoriaController;

$controller = new OuvidoriaController($pdo);

// Simples roteamento baseado na URL
$path = $_SERVER['REQUEST_URI'] ?? '/';
switch ($path) {
    case '/registrar-usuario':
        $resultado = $controller->registrarUsuario();
        include 'src/Views/usuario-form.php';
        break;
    case '/registrar-mensagem':
        $resultado = $controller->registrarMensagem();
        include 'src/Views/mensagem-form.php';
        break;
    default:
        echo "Página não encontrada.";
}