<?php
header('Content-Type: application/json'); // <-- Añade esta línea

$dir = __DIR__ . '/examinations_data/';
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['nombre']) && isset($data['contenido'])) {
    $filename = basename($data['nombre']);
    $filepath = $dir . $filename;
    file_put_contents($filepath, $data['contenido']);
    echo json_encode(['success' => true, 'message' => 'Archivo guardado correctamente en el servidor.']); // <-- Responde JSON
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']); // <-- Responde JSON
}
?>