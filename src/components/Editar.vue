<template>


<div class="container">
  <div class="card">
    <div class="card-header">
      Editar Pastel
    </div>
    <div class="card-body">
      <form v-on:submit.prevent="actualizarRegistro">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input
            type="text"
            class="form-control"
            name="nombre"
            id="nombre"
            v-model="pastel.Nombre"
            placeholder="Nombre"
          />
        </div>

        <div class="form-group">
          <label for="descripcion">Descripción</label>
          <input
            type="text"
            class="form-control"
            name="descripcion"
            id="descripcion"
            v-model="pastel.Descripcion"
            placeholder="Descripción"
          />
        </div>

        <div class="form-group">
          <label for="preparado_por">Preparado por</label>
          <input
            type="text"
            class="form-control"
            name="preparado_por"
            id="preparado_por"
            v-model="pastel.Preparado_por"
            placeholder="Preparado por"
          />
        </div>

        <div class="form-group">
          <label for="fecha_creacion">Fecha de Creación</label>
          <input
            type="date"
            class="form-control"
            name="fecha_creacion"
            id="fecha_creacion"
            v-model="pastel.Fecha_creacion"
          />
        </div>

        <div class="form-group">
          <label for="fecha_vencimiento">Fecha de Vencimiento</label>
          <input
            type="date"
            class="form-control"
            name="fecha_vencimiento"
            id="fecha_vencimiento"
            v-model="pastel.Fecha_vencimiento"
          />
        </div>

        <div class="btn-group" role="group" aria-label="">
          <button type="submit" class="btn btn-success">Modificar</button>
          <router-link :to="{ name: 'Listar' }" class="btn btn-warning">
            Cancelar
          </router-link>
        </div>
      </form>
    </div>
  </div>
</div>

</template>


<script>
export default {
  data() {
    return {
      pastel: {} // Objeto para almacenar los datos del pastel
    };
  },
  created() {
    this.obtenerInformacionId();
  },
  methods: {
    obtenerInformacionId() {
      // Verifica que el parámetro `id` exista.
      if (!this.$route.params.ID_pastel) {
        console.error("El parámetro 'id' no está definido.");
        return;
      }

      fetch(`http://localhost/index.php/?consultar=${this.$route.params.ID_pastel}`)
        .then((respuesta) => {
          if (!respuesta.ok) {
            throw new Error("Error en la respuesta de la API.");
          }
          return respuesta.json();
        })
        .then((datosRespuesta) => {
          if (datosRespuesta && datosRespuesta.length > 0) {
            this.pastel = datosRespuesta[0];
          } else {
            console.error(
              "No se encontraron datos para el pastel con ID:",
              this.$route.params.ID_pastel
            );
          }
        })
        .catch((error) => {
          console.error("Error al obtener la información del pastel:", error);
        });
    },

    actualizarRegistro() {
  const datosEnviar = {
    id: this.$route.params.ID_pastel, // ID del pastel obtenido de los parámetros de la ruta
    nombre: this.pastel.Nombre,
    descripcion: this.pastel.Descripcion,
    preparado_por: this.pastel.Preparado_por,
    fecha_creacion: this.pastel.Fecha_creacion,
    fecha_vencimiento: this.pastel.Fecha_vencimiento,
  };

  fetch("http://localhost/index.php/?actualizar", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(datosEnviar),
  })
    .then((respuesta) => {
      if (!respuesta.ok) {
        throw new Error(`Error en la respuesta del servidor: ${respuesta.status}`);
      }
      return respuesta.json();
    })
    .then((datosRespuesta) => {
      console.log("Respuesta del servidor:", datosRespuesta);
      if (datosRespuesta.success) {
        // Navega al listado si la actualización fue exitosa
        this.$router.push({ name: "Listar" });
      } else {
        console.error("Error al actualizar el registro:", datosRespuesta.error || "Error desconocido");
      }
    })
    .catch((error) => {
      console.error("Error al actualizar el registro:", error);
    });
}

  }
};
</script>
