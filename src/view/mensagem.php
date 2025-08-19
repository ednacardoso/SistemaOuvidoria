<?php
require_once __DIR__ . '/../templates/header.php';
?>
    <div class="logout-container">
        <a href="/logout.php" class="btn">Sair</a>
    </div>
    <div class="form-container">
        <h1 class="form-title">Envio de Mensagem</h1>
        <form method="POST" action="/mensagem.php">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" required></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" id="status" name="status" value="Pendente" readonly>
            </div>
            <button type="submit" class="btn">Cadastrar</button>
        </form>
        
        <?php if (isset($resultadoMensagem['sucesso'])): ?>
            <div class="success-message"><?php echo htmlspecialchars($resultadoMensagem['sucesso']); ?></div>
        <?php elseif (isset($resultadoMensagem['erro'])): ?>
            <div class="error-message"><?php echo htmlspecialchars($resultadoMensagem['erro']); ?></div>
        <?php endif; ?>
    </div>
<?php
require_once __DIR__ . '/../templates/footer.php';
?>
