<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/styleCriarResponsavel.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />
    <title>UniEvent</title>
</head>

<body>
    <header>
        <div class="container-logo">
            <img src="assets/images/logo3.png" alt="" class="logo">
            <p>Criar Responsável</p>
        </div>
        <a href="./home.html"><i class="fa-solid fa-arrow-left"></i>Voltar</a>
    </header>
    <form action="/UniEvent-Project/public/index.php?action=processarResponsavel" method="post" class="campos">

        <div>
            <p class="titulos">Nome Responsavel</p>

            <div class="input-container-titulo">
                <input type="text" name="nome" class="input-titulo" required />
            </div>
        </div>
        <div>
            <p class="titulos">Email</p>
            <div class="input-container-cap">
                <input type="email" name="email_contato" placeholder="N° máximo de pessoas" class="input-cap"
                    required />
            </div>

        </div>

        <div>

            <p class="titulos">Telefone</p>
            <div class="input-container-cap">
                <input type="number" name="telefone_contato" class="input-res" required />
            </div>
        </div>


        <div>
            <span><button class="btn" type="submit" value="enviar">Enviar <i
                        class="fa-solid fa-arrow-right"></i></button>
            </span>
        </div>

    </form>


    <script src="https://kit.fontawesome.com/1c065add65.js" crossorigin="anonymous"></script>
    <script src="assets/js/upload.js"></script>
</body>

</html>