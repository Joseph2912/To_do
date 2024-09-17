<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['listar'])) {
    try {
    
        $stmt = $pdo->query("SELECT t.id, t.nombre, t.fecha_creacion, e.id AS estado_id
                             FROM tareas t
                             JOIN estados e ON t.estado_id = e.id");
        $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($tareas as $tarea) {
            echo "<tr class='text-left align-middle'>
            <td>{$tarea['nombre']}</td>
            <td>{$tarea['fecha_creacion']}</td>
            <td>
                <select class='form-select' onchange=\"cambiarEstado({$tarea['id']}, this.value)\">
                    <option value='pendiente'" . ($tarea['estado_id'] == 1 ? ' selected' : '') . ">Pendiente</option>
                    <option value='realizado'" . ($tarea['estado_id'] == 2 ? ' selected' : '') . ">Realizado</option>
                    <option value='cancelado'" . ($tarea['estado_id'] == 3 ? ' selected' : '') . ">Cancelado</option>
                </select>
            </td>
            <td>
                <button class='btn btn-danger btn-sm' onclick=\"eliminarTarea({$tarea['id']})\">Eliminar</button>
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
