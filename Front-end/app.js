// Cargar las tareas ------------------------------------------------------------

document.addEventListener("DOMContentLoaded", function () {
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

// Crear tareas-------------------------------------------------------------------

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

// Eliminar tareas-------------------------------------------------------------------

function eliminarTarea(id) {
  fetch("http://localhost/Todo/Back-end/eliminar.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `id=${id}&eliminar=true`,
  })
    .then((response) => response.text())
    .then((data) => {
      console.log("Respuesta del servidor:", data); // Mostrar la respuesta en la consola
      cargarTareas(); // Actualizar la lista de tareas después de eliminar
    })
    .catch((error) => console.error("Error al eliminar la tarea:", error));
}

// Cambiar estados-------------------------------------------------------------------

function cambiarEstado(id, estado) {
  fetch("http://localhost/Todo/Back-end/actualiza_estado.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `id=${id}&estado=${encodeURIComponent(estado)}`,
  })
    .then((response) => response.text())
    .then((data) => {
      console.log("Respuesta del servidor:", data); // Mostrar la respuesta en la consola
      cargarTareas(); // Actualizar la lista de tareas después de cambiar el estado
    })
    .catch((error) => console.error("Error al actualizar el estado:", error));
}
