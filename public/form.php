<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Formulário de Contato</title>
</head>

<body>
    <h2>Cadastro de Contato</h2>
    <?php if (isset($_GET['erro'])): ?>
    <p style="color: red;">
        <?= match($_GET['erro']) {
                'dados_invalidos' => 'Dados inválidos! Verifique e-mail e telefone.',
                'metodo_invalido' => 'Método de envio incorreto.',
                default => 'Erro desconhecido.'
            } ?>
    </p>
    <?php endif; ?>

    <form action="index.php?action=processar" method="post">
        <label for="">Nome</label>
        <input type="text" name="nome" id="">
        <label for="email">E-mail Fatec:</label>
        <input type="email" name="email_contato" id="email" required placeholder="exemplo@fatec.sp.gov.br">

        <label for="telefone">Telefone (apenas números):</label>
        <input type="tel" name="telefone_contato" id="telefone" pattern="[0-9]{10,11}" required>

        <input type="submit" value="Enviar">
    </form>
</body>

</html>