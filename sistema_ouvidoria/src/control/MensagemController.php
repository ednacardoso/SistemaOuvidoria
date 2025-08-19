<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Login;
use PDO;

class MensagemController {
    private $messageModel;

    public function __construct(Message $messageModel) {
        $this->messageModel = $messageModel;
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