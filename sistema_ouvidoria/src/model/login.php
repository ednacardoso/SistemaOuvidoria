<?php
namespace App\Models;

class Login {
    // Este model não precisa mais de um construtor

    public function authenticate(string $email, string $senha): bool {
        if (empty($email) || empty($senha)) {
            throw new \InvalidArgumentException("Campos obrigatórios não preenchidos.");
        }

        try {
            // Usamos o Model User do Eloquent para buscar o usuário
            $user = User::where('email', $email)->first();
            
            // Se o usuário existe e a senha está correta
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
