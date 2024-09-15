<?php
// eliminar_tarea.php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])) {
    $id = $_POST['id'];

    $stmt = $pdo->prepare("DELETE FROM tareas WHERE id = ?");
    $stmt->execute([$id]);

    echo "Tarea eliminada con éxito";
}
?>
