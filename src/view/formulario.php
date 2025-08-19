<form method="POST" action="/registrar-mensagem">
    <input type="text" name="nome" placeholder="Seu nome" required>
    <input type="email" name="email" placeholder="Seu email" required>
    <input type="text" name="cpf" placeholder="Seu CPF" required>
    <input type="password" name="senha" placeholder="Sua senha" required>
    <input type="text" name="telefone" placeholder="Seu telefone (opcional)">
    <input type="text" name="titulo" placeholder="Título da mensagem" required>
    <textarea name="descricao" placeholder="Descrição da mensagem" required></textarea>
    <button type="submit">Enviar</button>
</form>
<?php
if (isset($resultado['sucesso'])) {
    echo "<p style='color: green;'>{$resultado['sucesso']}</p>";
} elseif (isset($resultado['erro'])) {
    echo "<p style='color: red;'>{$resultado['erro']}</p>";
}