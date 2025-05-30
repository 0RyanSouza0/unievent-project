<?php
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <label for="">Nome</label>
        <input type="text" name="nome" />
        <label for="">Telefone</label>
        <input type="text" name="nome" />
        <label for="">Email</label>
        <input type="text" name="nome" />
        <input type="submit" value="enviar" />
    </form>
</body>

</html>