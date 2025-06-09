<!DOCTYPE html>
<html lang="pt">

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
        <div class="container-logo">
            <img src="assets/images/logo3.png" alt="Logo" class="logo" />
            <p data-i18n="create_event_title">Criar Evento</p>
        </div>
        <a href="./home.html" class="b-voltar"><i class="fa-solid fa-arrow-left"></i><span data-i18n="back_button"
                style="border:none;">Voltar</span></a>
    </header>

    <form action="/UniEvent-Project/public/index.php?action=processarEvento" method="post"
        enctype="multipart/form-data">
        <div class="campos">
            <div class="campos-1">
                <p class="titulos" data-i18n="label_title">Título</p>
                <div class="input-container-titulo">
                    <input type="text" name="titulo" class="input-titulo" required />
                </div>

                <p class="titulos" data-i18n="label_description">Descrição</p>
                <div class="input-container-desc">
                    <textarea class="input-desc" name="descricao" required></textarea>
                </div>

                <p class="titulos" data-i18n="label_capacity">Capacidade</p>
                <div class="input-container-cap">
                    <input type="number" name="capacidade" placeholder="N° máximo de pessoas" class="input-cap"
                        data-i18n-placeholder="placeholder_capacity" required />
                </div>
            </div>

            <div class="campos-2">
                <p class="titulos" data-i18n="label_responsible">Responsável</p>
                <div class="input-container-res">
                    <select name="responsavel" class="input-res" required>
                        <option value="ana">Ana</option>
                    </select>
                </div>

                <p class="titulos" data-i18n="label_image">Imagem</p>
                <div class="input-container-img">
                    <input type="file" name="thumbnail" id="upload" accept="image/*" required multiple />
                    <label for="upload" class="upload-label">
                        <input type="hidden" />
                        <img class="img-upload" src="assets/images/upload.png" id="preview" />
                    </label>
                </div>

                <p id="nomeArquivo" class="nomeArquivo"></p>

                <div class="input-container-data">
                    <p class="titulos" data-i18n="label_date">Data</p>
                    <input type="date" name="dataEvento" class="input-data" required />
                </div>
            </div>

            <div>
                <div class="input-container-hora">
                    <p class="titulos" data-i18n="label_time">Hora</p>
                    <input type="time" name="horaEvento" class="input-hora" required />
                </div>

                <p class="titulos" data-i18n="label_event_type">Tipo de Evento</p>
                <div class="input-container-res">
                    <select name="categoriaEvento" class="input-res" required>
                        <option value="Palestra">Palestra</option>
                    </select>
                </div>

                <div class="container-botão">
                    <button type="submit" data-i18n="preview_button">
                        Ver Prévia
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
    const translations = {
        en: {
            create_event_title: "Create Event",
            back_button: "Back",
            label_title: "Title",
            label_description: "Description",
            label_capacity: "Capacity",
            placeholder_capacity: "Max number of people",
            label_responsible: "Responsible",
            label_image: "Image",
            label_date: "Date",
            label_time: "Time",
            label_event_type: "Event Type",
            preview_button: "Preview"
        },
        pt: {
            create_event_title: "Criar Evento",
            back_button: "Voltar",
            label_title: "Título",
            label_description: "Descrição",
            label_capacity: "Capacidade",
            placeholder_capacity: "N° máximo de pessoas",
            label_responsible: "Responsável",
            label_image: "Imagem",
            label_date: "Data",
            label_time: "Hora",
            label_event_type: "Tipo de Evento",
            preview_button: "Ver Prévia"
        }
    };

    function setLanguage(lang) {
        localStorage.setItem("lang", lang);
        document.querySelectorAll("[data-i18n]").forEach((el) => {
            const key = el.getAttribute("data-i18n");
            if (translations[lang][key]) {
                el.textContent = translations[lang][key];
            }
        });
        document.querySelectorAll("[data-i18n-placeholder]").forEach((el) => {
            const key = el.getAttribute("data-i18n-placeholder");
            if (translations[lang][key]) {
                el.placeholder = translations[lang][key];
            }
        });
    }

    // Imagem upload preview
    const input = document.getElementById("upload");
    const preview = document.getElementById("preview");
    const nomeArquivo = document.getElementById("nomeArquivo");

    input.addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.addEventListener("load", function() {
                preview.setAttribute("src", this.result);
                preview.style.display = "block";
                preview.style.width = "290px";
                preview.style.maxHeight = "140px";
                preview.style.objectFit = "cover";
                preview.style.borderRadius = "10px";
            });
            reader.readAsDataURL(file);
        }

        if (input.files.length > 0) {
            const nomes = Array.from(input.files).map(
                (arquivo) => arquivo.name
            );
            nomeArquivo.textContent = `Arquivos: ${nomes.join(",")}`;
        } else {
            nomeArquivo.textContent = "Nenhum arquivo selecionado";
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        const savedTheme = localStorage.getItem("theme");
        if (savedTheme === "dark") {
            document.body.classList.add("dark-mode");
        }

        const savedLang = localStorage.getItem("lang") || "pt";
        setLanguage(savedLang);
    });
    </script>
</body>

</html>