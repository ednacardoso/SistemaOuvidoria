<!DOCTYPE html>
<html>
<head>
    <title>Envio de Mensagem</title>   
    <link rel="stylesheet" href="public/assets/scss/style.scss">
    <link rel="stylesheet" href="public/assets/css/styles.css">    
</head>
<body>
    <div style="text-align: right; padding: 10px;">
        <a href="/logout.php" style="color: white; text-decoration: none;">Sair</a>
    </div>
    <div id="cadastro">
        <h1>Envio de Mensagem</h1>
        <form method="POST" action="/mensagem.php">
            <div>
                <label>Título:</label>
                <input type="text" name="titulo" required>
            </div>
            <div>
                <label>Descrição:</label>
                <textarea name="descricao" required></textarea>
            </div>
            <div>
                <label>Status:</label>
                <input type="text" name="status" value="Pendente" required>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
    
    <?php if (isset($resultadoMensagem['sucesso'])): ?>
        <div style="color: green; margin-left: 10rem;"><?php echo htmlspecialchars($resultadoMensagem['sucesso']); ?></div>
    <?php elseif (isset($resultadoMensagem['erro'])): ?>
        <div style="color: red; margin-left: 10rem;"><?php echo htmlspecialchars($resultadoMensagem['erro']); ?></div>
    <?php endif; ?>
</body>
</html>