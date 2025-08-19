<?php
namespace App\model;

use App\model\User;

class Login {    

    public function authenticate(string $email, string $senha): bool {
        if (empty($email) || empty($senha)) {
            throw new \InvalidArgumentException("Campos obrigatórios não preenchidos.");
        }

        try {            
            $user = User::where('email', $email)->first();
            
            if ($user && password_verify($senha, $user->senha)) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            error_log("Erro ao autenticar usuário: " . $e->getMessage());
            return false;
        }
    }
}
