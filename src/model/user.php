<?php
namespace App\model;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'usuarios'; 
    public $timestamps = false; 

   
    protected $fillable = ['nome', 'email', 'cpf', 'senha', 'telefone'];

    public static function createUser(string $nome, string $email, string $cpf, string $senha, ?string $telefone = null): bool {
        if (empty($nome) || empty($email) || empty($cpf) || empty($senha)) {
            throw new \InvalidArgumentException("Campos obrigatórios não preenchidos.");
        }
        
        $existingUser = self::where('email', $email)->orWhere('cpf', $cpf)->first();
        if ($existingUser) {
            throw new \InvalidArgumentException("O e-mail ou CPF já está em uso.");
        }

        try {
            // Remove caracteres não numéricos do CPF e telefone
            $cpf = preg_replace('/[^0-9]/', '', $cpf);
            if ($telefone) {
                $telefone = preg_replace('/[^0-9]/', '', $telefone);
            }

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
            throw new \RuntimeException("Erro ao salvar o usuário no banco de dados.");
        }
    }
}
