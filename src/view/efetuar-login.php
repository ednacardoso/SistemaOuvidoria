<!DOCTYPE html>
<html>
<head>
    <title>Login de Usuário</title>
        <link rel="stylesheet" href="public/assets/scss/style.scss">
        <link rel="stylesheet" href="public/assets/css/styles.css">
</head>
<body>
    <div id="cadastro">
        <div id="titulo">
            <h1>Faça o seu Login</h1>
        </div>        
        <form method="POST" action="/efetuar-login">        
            <div>
                <label>Email:</label>
                <input id="form1" type="email" name="email" required>
            </div>       
            <div>
                <label>Senha:</label>
                <input id="form1" type="password" name="senha" required>
            </div>
            <button id="envio" type="submit">Entrar</button>
        </form>
    </div>    
    <?php if (isset($resultadoLogin['erro'])): ?>
        <div style="color: red; margin-left: 10rem;"><?php echo htmlspecialchars($resultadoLogin['erro']); ?></div>
    <?php endif; ?>
</body>
</html>