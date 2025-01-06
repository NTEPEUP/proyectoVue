<template>
    <div class="container">
      <div class="card">
        <div class="card-header">
          Agregar Nuevos Pasteles
        </div>
        <div class="card-body">
          <form v-on:submit.prevent="agregarRegistro">
            <!-- Campo Nombre -->
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input
                type="text"
                class="form-control"
                id="nombre"
                v-model="pastel.Nombre"
                placeholder="Escribe el nombre"
                required
              />
              <small class="form-text text-muted">Escribe el nombre del pastel</small>
            </div>
  
            <!-- Campo Descripción -->
            <div class="form-group">
              <label for="descripcion">Descripción</label>
              <input
                type="text"
                class="form-control"
                id="descripcion"
                v-model="pastel.Descripcion"
                placeholder="Escribe la descripción"
                required
              />
              <small class="form-text text-muted">Describe el pastel</small>
            </div>
  
            <!-- Campo Quién lo preparó -->
            <div class="form-group">
              <label for="preparado_por">Quién lo preparó</label>
              <input
                type="text"
                class="form-control"
                id="preparado_por"
                v-model="pastel.Preparado_por"
                placeholder="Escribe quién lo preparó"
                required
              />
              <small class="form-text text-muted">Indica quién preparó el pastel</small>
            </div>
  
            <!-- Campo Fecha de Creación -->
            <div class="form-group">
              <label for="fecha_creacion">Fecha de Creación</label>
              <input
                type="date"
                class="form-control"
                id="fecha_creacion"
                v-model="pastel.Fecha_Creacion"
                required
              />
              <small class="form-text text-muted">Selecciona la fecha de creación</small>
            </div>
  
            <!-- Campo Fecha de Vencimiento -->
            <div class="form-group">
              <label for="fecha_vencimiento">Fecha de Vencimiento</label>
              <input
                type="date"
                class="form-control"
                id="fecha_vencimiento"
                v-model="pastel.Fecha_Vencimiento"
                required
              />
              <small class="form-text text-muted">Selecciona la fecha de vencimiento</small>
            </div>
  
            <!-- Botones -->
            <div class="btn-group" role="group" aria-label="Acciones">
              <button type="submit" class="btn btn-success">Agregar</button>
              <router-link :to="{ name: 'Listar' }" class="btn btn-warning">Cancelar</router-link>
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
        pastel: {
          Nombre: "",
          Descripcion: "",
          Preparado_por: "",
          Fecha_Creacion: "",
          Fecha_Vencimiento: "",
        },
      };
    },
    methods: {
      agregarRegistro() {
        console.log(this.pastel);
  
        // Datos a enviar al backend
        const datosEnviar = {
          nombre: this.pastel.Nombre,
          descripcion: this.pastel.Descripcion,
          preparado_por: this.pastel.Preparado_por,
          fecha_creacion: this.pastel.Fecha_Creacion,
          fecha_vencimiento: this.pastel.Fecha_Vencimiento,
        };
  
        // Envío de datos al servidor
        fetch("http://localhost/index.php/?insertar=1", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(datosEnviar),
        })
          .then((respuesta) => respuesta.json())
          .then((datosRespuesta) => {
            console.log(datosRespuesta);
            window.location.href = "pastel_ingrediente";
          })
          .catch((error) => console.error("Error:", error));
      },
    },
  };
  </script>
  