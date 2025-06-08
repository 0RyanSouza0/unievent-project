<?php 

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/UniEvent-Project/src/View/assets/css/styleCriarEvento.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />

    <title>Atualizar Evento</title>
</head>

<body>
    <header>
        <div class="container-logo">
            <img src="/Unievent-Project/src/View/assets/images/logo3.png" alt="" class="logo">
            <p>Atualizar Evento</p>
        </div>
        <a href="/UniEvent-Project/public/index.php?action=listarEventos"><i class="fa-solid fa-arrow-left"></i>Voltar</a>
    </header>
    <form action="/UniEvent-Project/public/index.php?action=atualizarEvento&id=<?= $evento->getId() ?>" method="post"
        enctype="multipart/form-data">
        <div class="campos">
            <div class="campos-1">
                <p class="titulos">Titulo</p>
                <div class="input-container-titulo">
                    <input type="text" name="titulo" class="input-titulo" value="<?= $evento->getNome(); ?>" />
                </div>
                <p class="titulos">Descrição</p>
                <div class="input-container-desc">
                    <textarea class="input-desc" name="descricao" required><?= $evento->getDescricao(); ?></textarea>
                </div>
                <p class="titulos">Capacidade</p>
                <div class="input-container-cap">
                    <input type="number" name="capacidade" placeholder="N° máximo de pessoas" class="input-cap" value="<?= $evento->getCapacidade(); ?>"/>
                </div>
            </div>
            <div class="campos-2">
                <p class="titulos">Responsável</p>
                    <div class="input-container-res">
                    <select name="responsavel" class="input-res">
                        <option value="ana">Ana</option>
                    </select>
                    </div>
                <p class="titulos">Imagem</p>
                <div class="input-container-img">
                    <input type="file" name='thumbnail' id="upload" accept="image/*" />
                    <label for="upload" class="upload-label">
                        <input type="hidden">
                        <img class="img-upload" src="/Unievent-Project/public<?= $evento->getThumbnail() ?>" id="preview"/>
                    </label>
                </div>
                <div class="input-container-data">
                    <p class="titulos">Data</p>
                    <input type="date" name="dataEvento" class="input-data" value="<?= $evento->getDataEvento() ?>" />
                </div>
            </div>
            <div>
                <div class="input-container-hora">
                    <p class="titulos">Hora</p>
                    <input type="time" name="horaEvento" class="input-hora" value="<?= $evento->getHoraEvento() ?>" />
                </div>
                <p class="titulos">Tipo de Evento</p>

                <div class="input-container-res">
                    <select name="categoriaEvento" class="input-res" >
                        <option value="Palestra">Palestra</option>
                    </select>
                </div>

                <div class="container-botão">
                    <button type="submit">
                        Atualizar Evento
                    </button>
                </div>
            </div>
        </div>
    </form>
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


    <script src="https://kit.fontawesome.com/1c065add65.js" crossorigin="anonymous"></script>
    <script>
    const input = document.getElementById('upload');
    const input = document.getElementById('update');
    const preview = document.getElementById('preview');

    input.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.addEventListener('load', function() {
                preview.setAttribute('src', this.result);
                preview.style.display = 'block';
                preview.style.width = '290px';
                preview.style.maxHeight = '140px';
                preview.style.objectFit = 'cover';
                preview.style.borderRadius = '10px'
            });

            reader.readAsDataURL(file);
        }
    });
    </script>

</body>

</html>