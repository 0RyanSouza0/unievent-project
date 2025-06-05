<?php
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});
require_once __DIR__ . '/../src/Controller/ResponsavelEventoController.php';
require_once __DIR__ . '/../src/Controller/EventoController.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'processarResponsavel':
        $controller = new src\Controller\ResponsavelEventoController();
        $controller->processarFormulario();
        break;
        case 'processarEvento':
        $controller = new src\Controller\EventoController();
        $controller->processarFormulario();
        break;
    default:
        header('Location: form.php');
        exit;
}
?>