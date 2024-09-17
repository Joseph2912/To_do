<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear'])) {
    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        $fecha = date('Y-m-d');
        $estado_id = 1;

        try {
            $stmt = $pdo->prepare("INSERT INTO tareas (nombre, fecha_creacion, estado_id) VALUES (?, ?, ?)");
            $stmt->execute([$nombre, $fecha, $estado_id]);
            echo "Tarea creada";
        } catch (PDOException $e) {
            echo "Error al crear tarea: " . $e->getMessage();
        }
    } else {
        echo "No se recibió ningún nombre para la tarea.";
    }
} else {
    echo "No se recibió la solicitud correcta.";
}
?>
