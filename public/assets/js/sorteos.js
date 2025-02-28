function realizarSorteo(sorteo_id) {
  let premiosSeleccionados =
    JSON.parse(localStorage.getItem("premiosSeleccionados")) || [];
  let participantesSeleccionados =
    JSON.parse(localStorage.getItem("participantesSeleccionados")) || [];

  if (
    premiosSeleccionados.length === 0 ||
    participantesSeleccionados.length === 0
  ) {
    alert(
      "Debe seleccionar al menos un premio y un participante para realizar el sorteo."
    );
    return;
  }

  fetch("http://localhost:8080/admin/sorteos/realizar", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      premios: premiosSeleccionados.map((p) => p.id),
      participantes: participantesSeleccionados.map((p) => p.id),
      id_sorteo: sorteo_id,
    }),
  })
    .then((response) => {
      return response.ok ? response.json() : Promise.reject(response);
    })
    .then((data) => {
      console.log(data);
      // 📌 Mostrar los resultados en un modal
      mostrarResultadosSorteo(data);
    })
    .catch((error) => {
      error.json().then((data) => {
        console.error(data.error);
        alert(data.error);
      });
    });
}

// 📌 Al recargar la página, vacía el localStorage
localStorage.removeItem("premiosSeleccionados");
localStorage.removeItem("participantesSeleccionados");

let tipoPermitido = null; // Tipo de premios y participantes permitidos

function actualizarEventosSeleccion() {
  // Selección de premios
  document.querySelectorAll(".select-premio").forEach((button) => {
    button.removeEventListener("click", seleccionarPremio);
    button.addEventListener("click", seleccionarPremio);
  });

  // Selección de participantes
  document.querySelectorAll(".select-participante").forEach((button) => {
    button.removeEventListener("click", seleccionarParticipante);
    button.addEventListener("click", seleccionarParticipante);
  });
}

function seleccionarPremio() {
  let premioId = this.dataset.id;
  let premioTitulo = this.dataset.titulo;
  let tipoPremio = this.closest(".tab-pane").id; // Obtener la pestaña activa
  let listItem = this.closest(".premio-item"); // Buscar el contenedor correcto

  if (!listItem) return;

  let premiosSeleccionados =
    JSON.parse(localStorage.getItem("premiosSeleccionados")) || [];
  let index = premiosSeleccionados.findIndex((p) => p.id === premioId);

  if (index === -1) {
    // Seleccionar el premio
    if (
      confirm(`¿Desea seleccionar el premio "${premioTitulo}" para el sorteo?`)
    ) {
      premiosSeleccionados.push({
        id: premioId,
        titulo: premioTitulo,
        tipo: tipoPremio,
      });
      localStorage.setItem(
        "premiosSeleccionados",
        JSON.stringify(premiosSeleccionados)
      );

      // Resaltar el cuadro seleccionado
      listItem.classList.add("bg-warning", "text-dark");

      // Definir el tipo permitido para los participantes
      if (tipoPremio === "premios-granpremio") {
        tipoPermitido = [
          "participantes-conductores",
          "participantes-pasajeros",
        ];
      } else {
        tipoPermitido = [tipoPremio.replace("premios-", "participantes-")];
      }
    }
  } else {
    // Deseleccionar el premio
    if (confirm(`¿Desea quitar el premio "${premioTitulo}" del sorteo?`)) {
      premiosSeleccionados.splice(index, 1);
      localStorage.setItem(
        "premiosSeleccionados",
        JSON.stringify(premiosSeleccionados)
      );

      // Quitar resaltado
      listItem.classList.remove("bg-warning", "text-dark");

      // Si no hay más premios seleccionados, resetear el tipo permitido
      if (premiosSeleccionados.length === 0) {
        tipoPermitido = null;
      }
    }
  }
  console.log("Premios seleccionados:", premiosSeleccionados);
}

function seleccionarParticipante() {
  let participanteId = this.dataset.id;
  let participanteNombre = this.dataset.nombre;
  let tipoParticipante = this.closest(".tab-pane").id; // Obtener la pestaña activa
  let listItem = this.closest(".participante-item"); // Buscar el contenedor correcto

  if (!listItem) return;

  // Si no hay premios seleccionados, no permitir seleccionar participantes
  if (!tipoPermitido) {
    alert("Debe seleccionar un premio primero antes de elegir participantes.");
    return;
  }

  // Verificar si el tipo de participante es válido
  if (!tipoPermitido.includes(tipoParticipante)) {
    alert(
      `Solo puedes seleccionar participantes de la categoría permitida: ${tipoPermitido.join(
        ", "
      )}`
    );
    return;
  }

  let participantesSeleccionados =
    JSON.parse(localStorage.getItem("participantesSeleccionados")) || [];
  let index = participantesSeleccionados.findIndex(
    (p) => p.id === participanteId
  );

  if (index === -1) {
    // Seleccionar el participante
    if (
      confirm(
        `¿Desea seleccionar al participante "${participanteNombre}" para el sorteo?`
      )
    ) {
      participantesSeleccionados.push({
        id: participanteId,
        nombre: participanteNombre,
        tipo: tipoParticipante,
      });
      localStorage.setItem(
        "participantesSeleccionados",
        JSON.stringify(participantesSeleccionados)
      );

      // Resaltar el cuadro seleccionado
      listItem.classList.add("bg-warning", "text-dark");
    }
  } else {
    // Deseleccionar el participante
    if (
      confirm(
        `¿Desea quitar al participante "${participanteNombre}" del sorteo?`
      )
    ) {
      participantesSeleccionados.splice(index, 1);
      localStorage.setItem(
        "participantesSeleccionados",
        JSON.stringify(participantesSeleccionados)
      );

      // Quitar resaltado
      listItem.classList.remove("bg-warning", "text-dark");
    }
  }
  console.log("Participantes seleccionados:", participantesSeleccionados);
}

function mostrarResultadosSorteo(data) {
  let modalBody = document.getElementById("modalResultadosBody");
  modalBody.innerHTML = "";

  modalBody.innerHTML += `<p><strong>${data.ganador.premio.titulo}</strong> → 🎉 ${data.ganador.nombre_completo} 🎊</p>`;
  if (data.sorteo.tipo == "gran_premio") {
    modalBody.innerHTML += `<p><strong>${data.ganador2.premio.titulo}</strong> → 🎉 ${data.ganador2.nombre_completo} 🎊</p>`;
  }
  let modal = new bootstrap.Modal(document.getElementById("modalResultados"));
  modal.show();
}

// Bloquear cambio de pestañas si ya hay selecciones
document.querySelectorAll(".nav-link").forEach((tab) => {
  tab.addEventListener("click", function (e) {
    let nuevaPestaña = this.getAttribute("href").replace("#", "");

    // Si ya hay una pestaña activa, bloquear el cambio completamente
    if (tipoPermitido && !tipoPermitido.includes(nuevaPestaña)) {
      alert(
        `Solo puedes seleccionar participantes de la pestaña permitida: ${tipoPermitido.join(
          ", "
        )}`
      );
      e.preventDefault(); // 🔴 Evita que la pestaña cambie
      return false;
    }

    setTimeout(actualizarEventosSeleccion, 100); // Asegurar que los eventos estén activos en la pestaña
  });
});

// Llamamos la función para asignar eventos al cargar la página
actualizarEventosSeleccion();
