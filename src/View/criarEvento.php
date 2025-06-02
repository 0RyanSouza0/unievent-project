<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/styleCriarEvento.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
      rel="stylesheet"
    />
    <title>UniEvent</title>
</head>
<body>
    <header>
        <img src="assets/images/logo3.png" alt="" class="logo">
        <p>Criar Evento</p>
    </header>
    
    <form action="/UniEvent-Project/public/index.php?action=processarEvento" 
          class="campos-3" 
          method="post"
          enctype="multipart/form-data">
        
      <div class="campos">
        <div class="campos-1">
            <p class="titulos">Título</p>
            <div class="input-container-titulo">
                <input type="text" name="titulo" class="input-titulo" required/>
            </div>
            
            <p class="titulos">Descrição</p>
            <div class="input-container-desc">
                <textarea class="input-desc" name='descricao' required></textarea>
            </div>
            
            <p class="titulos">Capacidade</p>
            <div class="input-container-cap">
                <input type="number" name="capacidade" placeholder="N° máximo de pessoas" class="input-cap" required/>
            </div>
        </div>
        
        <div class="campos-2">
            <p class="titulos">Responsável</p>
            <div class="input-container-res">
                <input type="text" name="responsavel" class="input-res" required/>
            </div>
            
            <p class="titulos">Imagem</p>
            <div class="input-container-img">
                <input type="file" name='thumbnail' id="upload" class="input-img" accept="image/*" required/>
                <label for="upload" class="upload-label">
                    <img class="img-upload" src="assets/images/upload.png"/>
                    <span>Selecionar imagem</span>
                </label>
            </div>
            
            <div class="input-container-hora">
                <input type="time" name="horaEvento" class="input-hora" required/>
            </div>
            
            <div class="input-container-data">
                <input type="date" name="dataEvento" class="input-data" required/>
            </div>
        </div>

        <div class="categorias">
            <p class="titulos">Categorias</p>
            <label>
              <input type="checkbox" name="categoriaEvento" value="opcao1">
              Opção 1
            </label>
            <label>
              <input type="checkbox" name="option2" value="opcao2">
              Opção 2
            </label>
            <label>
              <input type="checkbox" name="option3" value="opcao3">
              Opção 3
            </label>  
        </div>
        
        <input type="submit" value="Enviar">
      </div>
    </form>

    <!-- <script>
    // Função simplificada para trigger no input file
    function escolherArquivo() {
        document.getElementById('upload').click();
    }
    
    // Mostrar nome do arquivo selecionado (opcional)
    document.getElementById('upload').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'Nenhum arquivo selecionado';
        console.log('Arquivo selecionado:', fileName);
    });
    </script> -->
</body>
</html>