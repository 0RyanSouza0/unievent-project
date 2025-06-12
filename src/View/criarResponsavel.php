<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/styleCriarResponsavel.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />
    <title data-i18n="page_title">UniEvent</title>
</head>

<body>
    <header>
        <div class="container-logo">
            <img src="assets/images/logo3.png" alt="Logo" class="logo" />
            <p data-i18n="create_responsible">Criar Responsável</p>
        </div>
        <a href="./home.php" class="b-voltar"><i class="fa-solid fa-arrow-left"></i><span data-i18n="back"
                style="border:none; margin:0px; width:auto;">Voltar</span></a>
    </header>

    <form action="/UniEvent-Project/public/index.php?action=processarResponsavel" method="post" class="campos">
        <div>
            <p class="titulos" data-i18n="label_name">Nome Responsável</p>
            <div class="input-container-titulo">
                <input type="text" name="nome" class="input-titulo" required data-i18n-placeholder="placeholder_name"
                    placeholder="Nome Responsável" />
            </div>
        </div>
        <div>
            <p class="titulos" data-i18n="label_email">Email</p>
            <div class="input-container-cap">
                <input type="email" name="email_contato" class="input-cap" required
                    data-i18n-placeholder="placeholder_email" placeholder="Digite o email" />
            </div>
        </div>
        <div>
            <p class="titulos" data-i18n="label_phone">Telefone</p>
            <div class="input-container-cap">
                <input type="number" name="telefone_contato" class="input-res" required
                    data-i18n-placeholder="placeholder_phone" placeholder="Digite o telefone" />
            </div>
        </div>
        <div>
            <span>
                <button class="btn" type="submit" value="enviar" data-i18n="send">
                    Enviar <i class="fa-solid fa-arrow-right"></i>
                </button>
            </span>
        </div>
    </form>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        form.addEventListener("submit", function(e) {
            window.alert("Responsável Criado com Sucesso!");
        });
    });
    </script>

    <script src="https://kit.fontawesome.com/1c065add65.js" crossorigin="anonymous"></script>

    <script>
    const translations = {
        en: {
            page_title: "UniEvent",
            create_responsible: "Create Responsible",
            back: "Back",
            label_name: "Responsible Name",
            label_email: "Email",
            label_phone: "Phone",
            placeholder_name: "Responsible Name",
            placeholder_email: "Enter email",
            placeholder_phone: "Enter phone number",
            send: "Send"
        },
        pt: {
            page_title: "UniEvent",
            create_responsible: "Criar Responsável",
            back: "Voltar",
            label_name: "Nome Responsável",
            label_email: "Email",
            label_phone: "Telefone",
            placeholder_name: "Nome Responsável",
            placeholder_email: "Digite o email",
            placeholder_phone: "Digite o telefone",
            send: "Enviar"
        }
    };

    function setLanguage(lang) {
        localStorage.setItem("lang", lang);
        document.querySelectorAll("[data-i18n]").forEach(el => {
            const key = el.getAttribute("data-i18n");
            if (translations[lang][key]) {
                el.textContent = translations[lang][key];
            }
        });
        document.querySelectorAll("[data-i18n-placeholder]").forEach(el => {
            const key = el.getAttribute("data-i18n-placeholder");
            if (translations[lang][key]) {
                el.placeholder = translations[lang][key];
            }
        });
    }

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