<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Animado</title>
    <link rel="stylesheet" href="assets/css/styleLogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3ba46d9076.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="login-container">
        <div class="content first-content">
            <div class="first-column">
                <a href="index.php" class='arrow-button'>
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h2 class='titulo titulo-primary'>Bem-Vindo!</h2>
                <p class="descricao descricao-primary">Entre com seus dados de login</p>
                <p class="descricao descricao-primary">para começar a experiência</p>
                <button id='signin' class='btn btn-primary'>Entrar</button>
            </div>
            <div class="second-column">
                <h2 class="titulo titulo-second">Criar conta</h2>
                <p class="descricao descricao-second">Utilize seu email institucional</p>
                <form action="#" class="formulario">
                    <label class='label-input'>
                        <i class="fa-solid fa-user icon-modify"></i>
                        <input type="text" name="nome" placeholder='Nome'>
                    </label>
                    <label class='label-input'>
                        <i class="fa-solid fa-envelope icon-modify"></i>
                        <input type="email" name="email" placeholder='Email Institucional'>
                    </label>
                    <label class='label-input'>
                        <i class="fa-solid fa-lock icon-modify"></i>
                        <input type="password" name="password" placeholder='Senha'>
                    </label>
                    <button class="btn btn-second">Cadastrar</button>
                </form>
            </div>
        </div>

        <div class="content second-content">
            <div class="first-column">
                <h2 class='titulo titulo-primary'>Olá!</h2>
                <p class="descricao descricao-primary">Para se conectar a nós</p>
                <p class="descricao descricao-primary">por favor, faça o cadastro</p>
                <button id='signup' class='btn btn-primary'>Cadastrar</button>
            </div>
            <div class="second-column">
                <h2 class="titulo titulo-second">Entre para iniciar</h2>
                <p class="descricao descricao-second">Utilize seu email institucional</p>
                <form action="/unievent-project/public/index.php?action=loginEntrar" class="formulario" method='post'>
                    <label class='label-input'>
                        <i class="fa-solid fa-envelope icon-modify"></i>
                        <input type="email" name="email" placeholder='Email Institucional'>
                    </label>
                    <label class='label-input'>
                        <i class="fa-solid fa-lock icon-modify"></i>
                        <input type="password" name="password" placeholder='Senha'>
                    </label>
                    <a class='password' href='#'>Esqueci minha senha</a>
                    <button class="btn btn-second" type='submit'>Entrar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/login.js"></script>
</body>
</html>
