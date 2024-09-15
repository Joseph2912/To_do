<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['listar'])) {
    try {
        $stmt = $pdo->query("SELECT t.id, t.nombre, t.fecha, e.nombre AS estado
                             FROM tareas t
                             JOIN estados e ON estados_id = e.id");
        $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Genera HTML para cada tarea
        foreach ($tareas as $tarea) {
            echo "<tr>
                    <td>{$tarea['nombre']}</td>
                    <td>{$tarea['fecha']}</td>
                    <td>{$tarea['estado']}</td>
                    <td>
                        <button onclick=\"eliminarTarea({$tarea['id']})\">Eliminar</button>
                        <!-- Botón para actualizar -->
                    </td>
                  </tr>";
        }
    } catch (PDOException $e) {
        echo "Error al cargar tareas: " . $e->getMessage();
    }
} else {
    echo "Solicitud incorrecta";
}
?>
