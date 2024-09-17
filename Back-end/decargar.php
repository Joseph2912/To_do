<?php
include 'db.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=informe_tareas.csv');

$output = fopen('php://output', 'w');

fputcsv($output, ['ID', 'Nombre', 'Fecha de Creación', 'Estado']);

$query = "SELECT t.id, t.nombre, t.fecha_creacion, e.nombre AS estado
          FROM tareas t
          JOIN estados e ON t.estado_id = e.id
          WHERE t.estado_id = 2";
$stmt = $pdo->query($query);
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($tareas as $tarea) {
    fputcsv($output, [$tarea['id'], $tarea['nombre'], $tarea['fecha_creacion'], $tarea['estado']]);
}

fclose($output);
?>
