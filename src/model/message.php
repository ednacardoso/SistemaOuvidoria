<?php
namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {
    protected $table = 'mensagens';
    public $timestamps = false;
    protected $fillable = ['titulo', 'descricao', 'status'];

    public static function createMessage(string $titulo, string $descricao, string $status): bool {
        if (empty($titulo) || empty($descricao)) {
            throw new \InvalidArgumentException("Campos obrigatórios não preenchidos.");
        }

        try {
            self::create([
                'titulo' => $titulo,
                'descricao' => $descricao,
                'status' => $status
            ]);
            return true;
        } catch (\Exception $e) {
            error_log("Erro ao criar mensagem: " . $e->getMessage());
            return false;
        }
    }
}
