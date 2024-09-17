<?php

include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM tareas WHERE id = ?");
        $stmt->execute([$id]);
        echo "Tarea eliminada con éxito";
    } catch (PDOException $e) {
        echo "Error al eliminar la tarea: " . $e->getMessage();
    }
} else {
    echo "No se proporcionó un ID válido.";
}
?>
