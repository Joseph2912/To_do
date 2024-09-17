<?php

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['estado'])) {
    $id = $_POST['id'];
    $estado = $_POST['estado'];

    $estados = [
        'pendiente' => 1,
        'realizado' => 2,
        'cancelado' => 3
    ];

    if (array_key_exists($estado, $estados)) {
        $estado_numero = $estados[$estado];
        try {
           
            $stmt = $pdo->prepare("UPDATE tareas SET estado_id = ? WHERE id = ?");
            $stmt->execute([$estado_numero, $id]);
            echo "Estado actualizado";
        } catch (PDOException $e) {
            echo "Error al actualizar el estado: " . $e->getMessage();
        }
    } else {
        echo "Estado no válido.";
    }
} else {
    echo "No se proporcionaron parámetros válidos.";
}
