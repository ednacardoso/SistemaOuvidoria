<?php include __DIR__ . '/../templates/header.php'; ?>
    <div class="form-container">
        <h1 class="form-title">
            Sistema de Ouvidoria
        </h1>

         <h1 class="form-title">
            <img src="/assets/img/ipem.png" alt="Logo IPEM" style="width: 150px; display: block; margin: 0 auto 20px;">
            Faça o seu login
        </h1>
        
        <form method="POST" action="/efetuar-login">        
            <div class="form-group">
                <label for="email">Email:</label>
                <input id="email" type="email" name="email" required>
            </div>       
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input id="senha" type="password" name="senha" required>
            </div>
            <button class="btn" type="submit">Entrar</button>
        </form>

        <div class="register-link">
            <p>Não tem uma conta? <a href="/user">Cadastre-se</a></p>
        </div>
        
        <?php if (isset($resultadoLogin['erro'])): ?>
            <div class="error-message"><?php echo htmlspecialchars($resultadoLogin['erro']); ?></div>
        <?php endif; ?>
    </div>    
<?php include __DIR__ . '/../templates/footer.php'; ?>
