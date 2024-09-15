// Cargar las tareas cuando la página se carga
document.addEventListener("DOMContentLoaded", function() {
    cargarTareas(); // Cargar tareas automáticamente al cargar la página
  });
  
  function cargarTareas() {
    fetch("http://localhost/Todo/Back-end/listar_tareas.php?listar")
      .then((response) => {
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.text(); // Usa text() en lugar de json()
      })
      .then((html) => {
        const lista = document.getElementById("lista-tareas");
        lista.innerHTML = html; // Inserta el HTML directamente
      })
      .catch((error) => console.error("Error al cargar tareas:", error));
  }
  
  function crearTarea() {
    const nombre = document.getElementById("nombre").value;
  
    if (!nombre) {
      console.error("El nombre de la tarea está vacío");
      return;
    }
  
    fetch("http://localhost/Todo/Back-end/crear_tareas.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `crear=true&nombre=${encodeURIComponent(nombre)}`,
    })
      .then((response) => response.text()) // Cambia de .json() a .text()
      .then((data) => {
        console.log("Respuesta del servidor:", data); // Mostrar la respuesta en la consola
        document.getElementById("crear-tarea").reset();
        cargarTareas(); // Actualizar la lista de tareas después de crear una
      })
      .catch((error) => console.error("Error:", error));
  }
  
  function eliminarTarea(id) {
    fetch("eliminar.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `eliminar=true&id=${id}`,
    })
      .then((response) => response.text())
      .then(() => {
        cargarTareas(); // Actualizar la lista después de eliminar una tarea
      });
  }
  