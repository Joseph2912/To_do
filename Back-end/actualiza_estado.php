<?php
// actualizar_estado.php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['estado'])) {
    $id = $_POST['id'];
    $estado = $_POST['estado'];

    // Mapear los estados de texto a números
    $estados = [
        'pendiente' => 1,
        'realizado' => 2,
        'cancelado' => 3
    ];

    // Verificar si el estado es válido
    if (array_key_exists($estado, $estados)) {
        $estado_numero = $estados[$estado];
        try {
            // Cambia 'estado' por 'estados_id' o el nombre correcto de la columna en tu tabla
            $stmt = $pdo->prepare("UPDATE tareas SET estados_id = ? WHERE id = ?");
            $stmt->execute([$estado_numero, $id]);
            echo "Estado actualizado con éxito";
        } catch (PDOException $e) {
            echo "Error al actualizar el estado: " . $e->getMessage();
        }
    } else {
        echo "Error: Estado no válido.";
    }
} else {
    echo "Error: No se proporcionaron parámetros válidos.";
}
