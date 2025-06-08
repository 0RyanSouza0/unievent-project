<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <title>Tabela de Eventos</title>
    <style>
      :root {
        --primary-orange: #f56f22;
        --primary-black: #272727;
        --primary-white: #ffffff;
        --primary-gray: #d9d9d9;
        --primary-font: "Plus Jakarta Sans", sans-serif;
      }

      * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
        font-family: var(--primary-font);
      }

      html {
        scroll-behavior: smooth;
      }

      body {
        background-color: var(--primary-black);
      }

      header {
        display: flex;
        height: 200px;
        align-items: center;
        padding: 20px;
        width: 100%;
        justify-content: space-between;
      }

      header .container-logo {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
      }

      header a {
        text-decoration: none;
        color: var(--primary-white);
        font-size: 1rem;
        padding: 8px;
        border: 1px solid var(--primary-orange);
        display: flex;
        font-family: var(--primary-font);
        font-weight: 800;
        align-items: center;
        justify-content: center;
        gap: 5px;
        margin-bottom: 20px;
        border-radius: 10px;
        transition: 0.2s all ease-in-out;
      }

      header a i {
        font-size: 1rem;
        color: var(--primary-white);
      }

      header a:hover {
        transition: 0.2s all ease-in-out;
        background-color: var(--primary-orange);
        border: var(--primary-orange);
        padding: 8px;
      }

      .logo {
        width: 350px;
        height: 70px;
      }

      header p {
        font-family: var(--primary-font);
        font-weight: 800;
        font-size: 40px;
        text-decoration: none;
        color: var(--primary-white);
        margin-top: 15px;
      }

      h2 {
        color: var(--primary-white);
        text-align: center;

        font-family: var(--primary-font);
      }

      table {
        width: 90%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: var(--primary-black);
        color: #ffffff;
        border: 1px solid #444;
        margin: 0 auto 0 auto;
      }

      th,
      td {
        padding: 10px;
        text-align: left;
        border: 1px solid #444;

        font-family: var(--primary-font);
      }

      th {
        background-color: var(--primary-orange);
        color: var(--primary-white);

        font-family: var(--primary-font);
        font-weight: bold;
      }

      td {
        background-color: #333;
      }

      img {
        width: 100px;
        height: auto;
        border-radius: 4px;
        display: block;
        margin: 0 auto;
      }

      .acoes {
        display: flex;
        gap: 10px;
        background-color: var(--primary-orange);
        align-items: center;
        justify-content: center;
        height: 80px;
      }

      .botao-acao {
        border: none;
        cursor: pointer;
        text-decoration: none;
        font-size: 18px;
      }

      .botao-acao i:hover {
        color: var(--primary-black);
      }
      .botao-acao i {
        color: var(--primary-white);
      }
    </style>
  </head>

  <body>
    <header>
      <div class="container-logo">
        <img src="/UniEvent-Project/src/View/assets/images/logo3.png" alt="" class="logo" />
        <p>Listagem de Eventos</p>
      </div>
      <a href="/UniEvent-Project/src/View/home.html"><i class="fa-solid fa-arrow-left"></i>Voltar</a>
    </header>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Responsável</th>
                <th>Tipo de Evento</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Imagem</th>
                <th>Descrição</th>
                <th>Capacidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($eventos)): ?>
                <tr>
                    <td colspan="10" style="text-align: center;">Nenhum evento encontrado</td>
                </tr>
            <?php else: ?>
                <?php foreach ($eventos as $evento): ?>
                <tr>
                    <td><?= htmlspecialchars($evento->getId()) ?></td>
                    <td><?= htmlspecialchars($evento->getNome()) ?></td>
                    <td>#Responsavel nao encontrado#</td>
                    <td><?= htmlspecialchars($evento->getCategoriaEvento()) ?></td>
                    <td><?= htmlspecialchars($evento->getDataEvento()) ?></td>
                    <td><?= htmlspecialchars($evento->getHoraEvento()) ?></td>
                    <td>
                        <?php if ($evento->getThumbnail()): ?>
                            <img src="/UniEvent-Project/public<?= htmlspecialchars($evento->getThumbnail()) ?>" alt="Thumbnail" style="width: 100px;">
                        <?php else: ?>
                            Sem imagem
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($evento->getDescricao()) ?></td>
                    <td><?= htmlspecialchars($evento->getCapacidade()) ?></td>
                    <td class="acoes">
                        <a class="botao-acao" title="Editar" href="/UniEvent-Project/public/index.php?action=visualizarAtualizarEvento&id=<?= $evento->getId() ?>"><i class="fa-solid fa-file-pen"></i></a>
                        <a class="botao-acao" title="Excluir" 
                          onclick="return confirm('Tem certeza que deseja excluir este evento?')" 
                          href="/UniEvent-Project/public/index.php?action=excluirEvento&id=<?= $evento->getId() ?>">
                          <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <script
      src="https://kit.fontawesome.com/1c065add65.js"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
