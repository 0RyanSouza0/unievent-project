<?php
// Autoload PSR-4
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

require_once __DIR__ . '/../Config/Connection.php';

use src\Controller\EventoController;
use src\Controller\ResponsavelEventoController;

try {
    $action = $_GET['action'] ?? 'home';
    
    $action = explode('?', $action)[0];
    $action = trim($action);
    $action = strtolower($action);

    // Roteamento
    switch ($action) {
        case 'processarresponsavel':
            $controller = new ResponsavelEventoController();
            $controller->processarFormulario();
            break;
            
        case 'updateresponsavel':
            $controller = new ResponsavelEventoController();
            $controller->processarUpdateResponsavel();
            break;
        case 'processarevento':
            $controller = new EventoController();
            $controller->processarFormulario();
            break;
        case 'listareventos':
            $controller = new EventoController();
            $controller->listarEventos();
            break;
        case 'home':
            // Página inicial padrão
            header('Location: ../View/home.html');
            exit;
        default:
            // Página não encontrada
            http_response_code(404);
            include __DIR__ . '/../View/404.php';
            exit;
    }
    
} catch (Exception $e) {
    // Tratamento de erros global
    http_response_code(500);
    echo "Erro: " . $e->getMessage();
    error_log($e->getMessage());
    exit;
}