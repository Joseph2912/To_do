<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['listar'])) {
    try {
        // Selecciona el id del estado en lugar del nombre
        $stmt = $pdo->query("SELECT t.id, t.nombre, t.fecha_creacion, e.id AS estado_id
                             FROM tareas t
                             JOIN estados e ON t.estado_id = e.id");
        $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Genera HTML para cada tarea
        foreach ($tareas as $tarea) {
            // Determina el color del badge dependiendo del estado
            $estadoBadge = '';
            switch ($tarea['estado_id']) {
                case 1:
                    $estadoBadge = "<span class='badge bg-warning text-dark'>Pendiente</span>";
                    break;
                case 2:
                    $estadoBadge = "<span class='badge bg-success'>Realizado</span>";
                    break;
                case 3:
                    $estadoBadge = "<span class='badge bg-danger'>Cancelado</span>";
                    break;
            }

            echo "<tr class='text-left align-middle'>
            <td>{$tarea['nombre']}</td>
            <td>{$tarea['fecha_creacion']}</td>
            <td>
                <select class='form-select' onchange=\"cambiarEstado({$tarea['id']}, this.value)\">
                    <option value='1'" . ($tarea['estado_id'] == 1 ? ' selected' : '') . ">Pendiente</option>
                    <option value='2'" . ($tarea['estado_id'] == 2 ? ' selected' : '') . ">Realizado</option>
                    <option value='3'" . ($tarea['estado_id'] == 3 ? ' selected' : '') . ">Cancelado</option>
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
