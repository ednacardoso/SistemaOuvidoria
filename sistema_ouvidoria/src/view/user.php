<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Usuário</title>
    <style>
        form { margin: 20px; }
        div { margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    <form method="POST" action="/registrar-usuario">
        <div>
            <label>Nome:</label>
            <input type="text" name="nome" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>CPF:</label>
            <input type="text" name="cpf" required>
        </div>
        <div>
            <label>Senha:</label>
            <input type="password" name="senha" required>
        </div>
        <div>
            <label>Telefone:</label>
            <input type="text" name="telefone">
        </div>
        <button type="submit">Cadastrar</button>
    </form>
    <?php if (isset($resultado['sucesso'])): ?>
        <div style="color: green"><?php echo $resultado['sucesso']; ?></div>
    <?php elseif (isset($resultado['erro'])): ?>
        <div style="color: red"><?php echo $resultado['erro']; ?></div>
    <?php endif; ?>
</body>
</html>