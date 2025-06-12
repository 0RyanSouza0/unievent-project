<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>Tabela de Eventos</title>
    <link rel="stylesheet" href="/Unievent-Project/src/View/assets/css/styleGerenciarEvento.css" />
</head>

<body>
    <header>
        <div class="container-logo">
            <img src="/UniEvent-Project/src/View/assets/images/logo3.png" alt="Logo" class="logo" />
            <p data-i18n="event_list_heading">Listagem de Eventos</p>
        </div>
        <a href="/UniEvent-Project/src/View/home.php">
            <i class="fa-solid fa-arrow-left"></i>
            <span data-i18n="back_button">Voltar</span>
        </a>
    </header>

    <table>
        <thead>
            <tr>
                <th data-i18n="table_id">ID</th>
                <th data-i18n="table_title">Título</th>
                <th data-i18n="table_responsible">Responsável</th>
                <th data-i18n="table_event_type">Tipo de Evento</th>
                <th data-i18n="table_date">Data</th>
                <th data-i18n="table_time">Hora</th>
                <th data-i18n="table_image">Imagem</th>
                <th data-i18n="table_description">Descrição</th>
                <th data-i18n="table_capacity">Capacidade</th>
                <th data-i18n="table_actions">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($eventos)): ?>
            <tr>
                <td colspan="10" style="text-align: center" data-i18n="no_events">Nenhum evento encontrado</td>
            </tr>
            <?php else: ?>
            <?php foreach ($eventos as $evento): ?>
            <tr>
                <td><?= htmlspecialchars($evento->getId()) ?></td>
                <td><?= htmlspecialchars($evento->getNome()) ?></td>
                <td>Ana</td>
                <td><?= htmlspecialchars($evento->getCategoriaEvento()) ?></td>
                <td><?= htmlspecialchars($evento->getDataEvento()) ?></td>
                <td><?= htmlspecialchars($evento->getHoraEvento()) ?></td>
                <td>
                    <?php if ($evento->getThumbnail()): ?>
                    <img src="/UniEvent-Project/public<?= htmlspecialchars($evento->getThumbnail()) ?>" alt="Thumbnail"
                        style="width: 100px" />
                    <?php else: ?>
                    <span data-i18n="no_image">Sem imagem</span>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($evento->getDescricao()) ?></td>
                <td><?= htmlspecialchars($evento->getCapacidade()) ?></td>
                <td class="acoes">
                    <a class="botao-acao" title="Editar"
                        href="/UniEvent-Project/public/index.php?action=visualizarAtualizarEvento&id=<?= $evento->getId() ?>">
                        <i class="fa-solid fa-file-pen"></i>
                    </a>

                    <a class="botao-acao" title="Excluir"
                        onclick="return confirm('Tem certeza que deseja excluir este evento?')"
                        href="/UniEvent-Project/public/index.php?action=excluirEvento&id=<?= $evento->getId() ?>">
                        <i class="fa-solid fa-trash"></i>
                    </a>

                    <a class="botao-acao" title="Visualizar Preview" href="/UniEvent-Project/src/View/previaEvento.php">
                        <img src="/Unievent-Project/src/View/assets/images/previewIcon.svg" alt="" srcset="">
                    </a>


                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <script src="https://kit.fontawesome.com/1c065add65.js" crossorigin="anonymous"></script>

    <script>
    const translations = {
        en: {
            event_table_title: "Event Table",
            event_list_heading: "Event Listing",
            back_button: "Back",
            table_id: "ID",
            table_title: "Title",
            table_responsible: "Responsible",
            table_event_type: "Event Type",
            table_date: "Date",
            table_time: "Time",
            table_image: "Image",
            table_description: "Description",
            table_capacity: "Capacity",
            table_actions: "Actions",
            no_events: "No events found",
            no_image: "No image"
        },
        pt: {
            event_table_title: "Tabela de Eventos",
            event_list_heading: "Listagem de Eventos",
            back_button: "Voltar",
            table_id: "ID",
            table_title: "Título",
            table_responsible: "Responsável",
            table_event_type: "Tipo de Evento",
            table_date: "Data",
            table_time: "Hora",
            table_image: "Imagem",
            table_description: "Descrição",
            table_capacity: "Capacidade",
            table_actions: "Ações",
            no_events: "Nenhum evento encontrado",
            no_image: "Sem imagem"
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