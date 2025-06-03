<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
        <p>Gerenciar Usuarios</p>
    </header>
    
    <form action="/UniEvent-Project/public/index.php?action=updateResponsavel" 
          class="campos-3" 
          method="post">

        <label>Nome: </label>
        <input type="text" name="nome" class="input-res" required/>

        <label>Telefone: </label>
        <input type="text" name="telefone_contato" class="input-res" required/>
        
        <input type="submit" value="Enviar">
      </div>
    </form>
</body>
</html>