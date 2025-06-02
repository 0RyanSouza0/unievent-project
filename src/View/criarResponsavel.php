<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/styleCriarEvento.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />
    <title>UniEvent</title>
</head>

<body>
    <header>
        <img src="assets/images/logo3.png" alt="" class="logo">
        <p>Criar Evento</p>
    </header>
    <div class="campos">
        <div class="campos-1">
            <p class="titulos">Nome Responsavel</p>
            <form action="/UniEvent-Project/public/index.php?action=processar" class="campos-3" method="post">
                <div class="input-container-titulo">
                    <input type="text" name="nome" class="input-titulo" required />
                </div>
                <p class="titulos">Email</p>
                <div class="input-container-cap">
                    <input type="email" name="email_contato" placeholder="N° máximo de pessoas" class="input-cap"
                        required />
                </div>
        </div>
        <div class="campos-2">
            <p class="titulos">telefone_contato</p>
            <div class="input-container-res">
                <input type="number" name="telefone_contato" class="input-res" required />
            </div>

            <input type="submit" value="enviar">
        </div>


        </form>

    </div>
    <script src="assets/js/upload.js"></script>
</body>

</html>