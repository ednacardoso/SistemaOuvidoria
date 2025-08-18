<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'usuarios'; // Nome da tabela no banco
    public $timestamps = false; // Desativa colunas created_at e updated_at

    // Define quais campos podem ser preenchidos em massa
    protected $fillable = ['nome', 'email', 'cpf', 'senha', 'telefone'];

    public static function createUser(string $nome, string $email, string $cpf, string $senha, ?string $telefone = null): bool {
        if (empty($nome) || empty($email) || empty($cpf) || empty($senha)) {
            throw new \InvalidArgumentException("Campos obrigatórios não preenchidos.");
        }

        try {
            // O Eloquent cuida do hashing automaticamente se usarmos um "mutator"
            // Mas para simplificar, vamos fazer aqui por enquanto.
            self::create([
                'nome' => $nome,
                'email' => $email,
                'cpf' => $cpf,
                'senha' => password_hash($senha, PASSWORD_BCRYPT),
                'telefone' => $telefone
            ]);
            return true;
        } catch (\Exception $e) {
            error_log("Erro ao criar usuário: " . $e->getMessage());
            return false;
        }
    }
}