<?php
// eliminar_tarea.php
include 'db.php';  // Asegúrate de que $pdo esté correctamente configurado

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
    echo "Error: No se proporcionó un ID válido.";
}
?>
