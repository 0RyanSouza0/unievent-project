<?php 
// Supondo que $evento esteja definido corretamente
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/UniEvent-Project/src/View/assets/css/styleCriarEvento.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />
    <title data-i18n="update_event">Atualizar Evento</title>
</head>

<body>
    <header>
        <div class="container-logo">
            <img src="/Unievent-Project/src/View/assets/images/logo3.png" alt="" class="logo">
            <p data-i18n="update_event">Atualizar Evento</p>
        </div>
        <a href="/UniEvent-Project/public/index.php?action=listarEventos" class="b-voltar">
            <i class="fa-solid fa-arrow-left"></i>
            <span data-i18n="back" style="border:none;">Voltar</span>
        </a>
    </header>

    <form action="/UniEvent-Project/public/index.php?action=atualizarEvento&id=<?= $evento->getId() ?>" method="post"
        enctype="multipart/form-data">
        <div class="campos">
            <div class="campos-1">
                <p class="titulos" data-i18n="title">Título</p>
                <div class="input-container-titulo">
                    <input type="text" name="titulo" class="input-titulo" value="<?= $evento->getNome(); ?>"
                        data-i18n-placeholder="title_placeholder" placeholder="Digite o título" />
                </div>
                <p class="titulos" data-i18n="description">Descrição</p>
                <div class="input-container-desc">
                    <textarea class="input-desc" name="descricao" required data-i18n-placeholder="desc_placeholder"
                        placeholder="Digite a descrição"><?= $evento->getDescricao(); ?></textarea>
                </div>
                <p class="titulos" data-i18n="capacity">Capacidade</p>
                <div class="input-container-cap">
                    <input type="number" name="capacidade" class="input-cap" placeholder="N° máximo de pessoas"
                        value="<?= $evento->getCapacidade(); ?>" data-i18n-placeholder="capacity_placeholder" />
                </div>
            </div>
            <div class="campos-2">
                <p class="titulos" data-i18n="responsible">Responsável</p>
                <div class="input-container-res">
                    <select name="responsavel" class="input-res">
                        <option value="ana">Ana</option>
                    </select>
                </div>
                <p class="titulos" data-i18n="image">Imagem</p>
                <div class="input-container-img">
                    <input type="file" name='thumbnail' id="upload" accept="image/*"
                        value="<?= $evento->getThumbnail() ?>" />
                    <label for="upload" class="upload-label">
                        <img class="img-upload"
                            style="width:290px; max-height: 140px; object-fit:cover; border-radius:10px;"
                            src="/UniEvent-Project/public<?= htmlspecialchars($evento->getThumbnail()) ?>"
                            id="preview" />
                    </label>
                </div>
                <div class="input-container-data">
                    <p class="titulos" data-i18n="date">Data</p>
                    <input type="date" name="dataEvento" class="input-data" value="<?= $evento->getDataEvento() ?>" />
                </div>
            </div>
            <div>
                <div class="input-container-hora">
                    <p class="titulos" data-i18n="time">Hora</p>
                    <input type="time" name="horaEvento" class="input-hora" value="<?= $evento->getHoraEvento() ?>" />
                </div>
                <p class="titulos" data-i18n="event_type">Tipo de Evento</p>
                <div class="input-container-res">
                    <select name="categoriaEvento" class="input-res">
                        <option value="Palestra">Palestra</option>
                    </select>
                </div>
                <div class="container-botão">
                    <button type="submit" data-i18n="update_event">Atualizar Evento</button>
                </div>
            </div>
        </div>
    </form>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector("form");
        const uploadInput = document.getElementById("upload");

        form.addEventListener("submit", function(e) {
            if (!uploadInput.files || uploadInput.files.length === 0 || uploadInput.files.length != 0) {
                alert("Evento Atualizado com Sucesso");
            }
        });
    });
    </script>

    <script src="assets/js/buttonTiposEvento.js"></script>
    <script src="https://kit.fontawesome.com/1c065add65.js" crossorigin="anonymous"></script>
    <script>
    const input = document.getElementById('upload');
    const preview = document.getElementById('preview');

    input.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.addEventListener('load', function() {
                preview.setAttribute('src', this.result);
                preview.style.display = 'block';
                preview.style.minHeight = '140px';
                preview.style.objectFit = 'cover';
                preview.style.borderRadius = '10px';
            });

            reader.readAsDataURL(file);
        }
    });

    // Tema e tradução
    document.addEventListener('DOMContentLoaded', function() {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
        }

        const translations = {
            en: {
                update_event: "Update Event",
                back: "Back",
                title: "Title",
                description: "Description",
                capacity: "Capacity",
                responsible: "Responsible",
                image: "Image",
                date: "Date",
                time: "Time",
                event_type: "Event Type",
                title_placeholder: "Enter title",
                desc_placeholder: "Enter description",
                capacity_placeholder: "Max number of people"
            },
            pt: {
                update_event: "Atualizar Evento",
                back: "Voltar",
                title: "Título",
                description: "Descrição",
                capacity: "Capacidade",
                responsible: "Responsável",
                image: "Imagem",
                date: "Data",
                time: "Hora",
                event_type: "Tipo de Evento",
                title_placeholder: "Digite o título",
                desc_placeholder: "Digite a descrição",
                capacity_placeholder: "N° máximo de pessoas"
            }
        };

        const lang = localStorage.getItem('lang') || 'pt';

        document.querySelectorAll('[data-i18n]').forEach(el => {
            const key = el.getAttribute('data-i18n');
            if (translations[lang][key]) {
                el.textContent = translations[lang][key];
            }
        });

        document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
            const key = el.getAttribute('data-i18n-placeholder');
            if (translations[lang][key]) {
                el.placeholder = translations[lang][key];
            }
        });
    });
    </script>
</body>

</html>