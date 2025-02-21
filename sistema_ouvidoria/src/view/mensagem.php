<!DOCTYPE html>
<html>
<head>
    <title>Envio de Mensagem</title>
    <style>
        form { margin: 20px; }
        div { margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>Envio de Mensagem</h1>
    <form method="POST" action="/registrar-mensagem">
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
    <?php if (isset($resultado['sucesso'])): ?>
        <div style="color: green"><?php echo $resultado['sucesso']; ?></div>
    <?php elseif (isset($resultado['erro'])): ?>
        <div style="color: red"><?php echo $resultado['erro']; ?></div>
    <?php endif; ?>
</body>
</html>