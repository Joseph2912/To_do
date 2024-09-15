<?php
// actualizar_estado.php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nuevo_estado = $_POST['estado_id'];

    $stmt = $pdo->prepare("UPDATE tareas SET estado_id = ? WHERE id = ?");
    $stmt->execute([$nuevo_estado, $id]);

    echo "Estado actualizado con éxito";
}
?>
