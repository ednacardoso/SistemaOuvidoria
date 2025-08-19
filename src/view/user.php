<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Usuário</title>        
        <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="form-container">
        <div id="cadastro">
            <h1 class="form-title">Cadastro de Usuário</h1>
                <form method="POST" action="/user.php">
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="nome" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>CPF:</label>
                <input type="text" name="cpf" required>
            </div>
            <div class="form-group">
                <label>Senha:</label>
                <input type="password" name="senha" required>
            </div>
            <div class="form-group">
                <label>Telefone:</label>
                <input type="text" name="telefone">
            </div>
            <button class="btn" type="submit">Cadastrar</button>
            </form>
        </div>
    
        <?php if (isset($resultadoUser['sucesso'])): ?>
            <div style="color: green; margin-left: 10rem;"><?php echo htmlspecialchars($resultadoUser['sucesso']); ?></div>
        <?php elseif (isset($resultadoUser['erro'])): ?>
            <div style="color: red; margin-left: 10rem;"><?php echo htmlspecialchars($resultadoUser['erro']); ?></div>
        <?php endif; ?>
    </div>

</body>
</html>