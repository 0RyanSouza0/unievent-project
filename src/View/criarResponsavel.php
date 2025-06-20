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

    <form action="/UniEvent-Project/public/index.php?action=processarResponsavel" method="post" id="formulario"
        class="campos">
        <div>
            <p class="titulos" data-i18n="label_name">Nome Responsável</p>
            <div class="input-container-titulo">
                <input type="text" name="nome" id="nome" class="input-titulo" required
                    data-i18n-placeholder="placeholder_name" placeholder="Nome Responsável" />
            </div>
        </div>
        <div>
            <p class="titulos" data-i18n="label_email">Email</p>
            <div class="input-container-cap">
                <input type="email" name="email_contato" id="email" class="input-cap" required
                    data-i18n-placeholder="placeholder_email" placeholder="Digite o email" />
            </div>
        </div>
        <div>
            <p class="titulos" data-i18n="label_phone">Telefone</p>
            <div class="input-container-cap">
                <input type="number" name="telefone_contato" id="telefone" class="input-res" required
                    data-i18n-placeholder="placeholder_phone" placeholder="Digite o telefone" />
            </div>
        </div>

        <div class="container-modal" id="modal">
            <div class="content-modal">
                <button type="reset" id="btn-fechar" onclick="fecharModal();"><i class="fa-solid fa-xmark"></i></button>
                <img src="assets/images/emoteError.png" id="emote">
                <p id="conteudo" data-i18n="create"> Tem certeza que deseja criar o responsavel?</p>
                <p id="conteudo2" data-i18n="fills"> Preencha todos os campos ou verifique o email digitado</p>
                <button type="submit" id="btn-modal" data-i18n="btn_create">Criar</button>
            </div>
        </div>

    </form>
    <div class="container-botão">
        <button type="submit" data-i18n="send" id="btn" onclick="validaform();">
            Enviar
        </button>
    </div>


    <script src="https://kit.fontawesome.com/1c065add65.js" crossorigin="anonymous"></script>

    <script>
    const btn = document.getElementById("btn");
    const modal = document.getElementById("modal");
    const formulario = document.getElementById("formulario");
    const emoteError = document.getElementById("emote");
    const emoteAcess = document.getElementById("emoteAcess");
    var nome = document.getElementById("nome");
    var email = document.getElementById("email");
    var telefone = document.getElementById("telefone");
    const conteudo = document.getElementById("conteudo");
    const btnModal = document.getElementById("btn-modal");



    function validaform() {
        if (
            nome.value.trim() === "" ||
            email.value.trim() === "" ||
            telefone.value.trim() === "" ||
            !validarEmail(email.value)
        ) {
            const modal = document.getElementById('modal');
            const conteudo = document.getElementById('conteudo');

            modal.style.display = 'flex';
            modal.style.position = 'fixed';
            btnModal.style.display = 'none';
            emote.style.display = 'flex';
            emote.src = 'assets/images/emoteError.png';
            conteudo.style.textAlign = 'center';
            conteudo2.style.textAlign = 'center';
            conteudo2.style.display = 'flex';
            conteudo.style.display = 'none';
            formulario.reset();
            return false;
        } else {
            const modal = document.getElementById('modal');
            const conteudo = document.getElementById('conteudo');

            modal.style.display = 'flex';
            emote.style.display = 'flex';
            emote.src = 'assets/images/emoteAcess.png';
            btnModal.style.display = 'block';
            modal.style.position = 'fixed';
            conteudo.style.display = 'flex';
            conteudo2.style.display = 'none';
            conteudo.style.textAlign = 'center';
            return false;
        }
    };

    function validarEmail(email) {
        const regex = /^[a-zA-Z0-9._%+-]+@fatec\.sp\.gov\.br$/;
        return regex.test(email);
    }

    const btnFechar = document.getElementById("btn-fechar");

    function fecharModal() {
        formulario.reset();
        modal.style.display = "none";
    }
    </script>


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
            send: "Send",
            create: "Are you sure to create this event?",
            fills: "Fill in all the fields",
            btn_create: "Create"
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