<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['listar'])) {
    try {
        // Selecciona el id del estado en lugar del nombre
        $stmt = $pdo->query("SELECT t.id, t.nombre, t.fecha, e.id AS estado_id
                             FROM tareas t
                             JOIN estados e ON t.estados_id = e.id");
        $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Genera HTML para cada tarea
        foreach ($tareas as $tarea) {
            echo "<tr>
            <td>{$tarea['nombre']}</td>
            <td>{$tarea['fecha']}</td>
            <td>
                <select onchange=\"cambiarEstado({$tarea['id']}, this.value)\">
                    <option value='pendiente'" . ($tarea['estado_id'] == 1 ? ' selected' : '') . ">Pendiente</option>
                    <option value='realizado'" . ($tarea['estado_id'] == 2 ? ' selected' : '') . ">Realizado</option>
                    <option value='cancelado'" . ($tarea['estado_id'] == 3 ? ' selected' : '') . ">Cancelado</option>
                </select>
            </td>
            <td>
                <button onclick=\"eliminarTarea({$tarea['id']})\">Eliminar</button>
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
