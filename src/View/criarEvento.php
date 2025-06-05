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

    <title>Criar Evento</title>
</head>

<body>
    <header>
        <img src="assets/images/logo3.png" alt="" class="logo" />
        <p>Criar Evento</p>
    </header>
    <div class="campos">
        <div class="campos-1">
            <p class="titulos">Título</p>
            <div class="input-container-titulo">
                <input type="text" name="Título" class="input-titulo" required />
            </div>
            <p class="titulos">Descrição</p>
            <div class="input-container-desc">
                <textarea class="input-desc" name="descricao" required></textarea>
            </div>
            <p class="titulos">Capacidade</p>
            <div class="input-container-cap">
                <input type="number" name="capacidade" placeholder="N° máximo de pessoas" class="input-cap" required />
            </div>
        </div>
        <div class="campos-2">
            <p class="titulos">Responsável</p>
            <div class="input-container-res">
                <select name="Responsável" class="input-res" required>
                    <option value="ana">Ana</option>
                </select>
            </div>
            <p class="titulos">Imagem</p>
            <div class="input-container-img">
                <input type="file" name='thumbnail' id="upload" class="input-img" accept="image/*" required />
                <label for="upload" class="upload-label">
                    <img class="img-upload" src="assets/images/upload.png" />
                </label>
            </div>

            <div class="input-container-data">
                <p class="titulos">Data</p>
                <input type="date" name="dataEvento" class="input-data" required />
            </div>
        </div>
        <div>
            <div class="input-container-hora">
                <p class="titulos">Hora</p>
                <input type="time" name="horaEvento" class="input-hora" required />
            </div>
            <p class="titulos">Tipo de Evento</p>

            <div class="input-container-res">
                <select name="categoriaEvento" class="input-res" required>
                    <option value="Palestra">Palestra</option>
                </select>
            </div>

            <div class="container-botão">
                <button onclick="window.location.href = 'previaEvento.html';" type="submit">
                    Ver Prévia
                </button>
            </div>
        </div>
    </div>
    <script src="assets/js/buttonTiposEvento.js"></script>
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
    new window.VLibras.Widget("https://vlibras.gov.br/app");
    </script>
</body>

</html>