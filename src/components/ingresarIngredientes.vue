<template>
    <div class="container">
      <div class="card">
        <div class="card-header text-center">
          Agregar Nuevos ingredientes
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
                v-model="ingrediente.Nombre"
                placeholder="Escribe el nombre"
                required
              />
              <small class="form-text text-muted">Escribe el nombre del ingrediente</small>
            </div>
  
            <!-- Campo Descripción -->
            <div class="form-group">
              <label for="descripcion">Descripción</label>
              <input
                type="text"
                class="form-control"
                id="descripcion"
                v-model="ingrediente.Descripcion"
                placeholder="Escribe la descripción"
                required
              />
              <small class="form-text text-muted">Describe el ingrediente</small>
            </div>
  
            <!-- Campo Quién lo preparó -->
            
  
            <!-- Campo Fecha de Creación -->
            <div class="form-group">
              <label for="fecha_creacion">Fecha de Creación</label>
              <input
                type="date"
                class="form-control"
                id="fecha_creacion"
                v-model="ingrediente.Fecha_ingreso"
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
                v-model="ingrediente.Fecha_Vencimiento"
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
        ingrediente: {
          Nombre: "",
          Descripcion: "",
          
          Fecha_ingreso: "",
          Fecha_Vencimiento: "",
        },
      };
    },
    methods: {
      agregarRegistro() {
        console.log(this.ingrediente);
  
        // Datos a enviar al backend
        const datosEnviar = {
          nombre: this.ingrediente.Nombre,
          descripcion: this.ingrediente.Descripcion,
          
          fecha_ingreso: this.ingrediente.Fecha_ingreso,
          fecha_vencimiento: this.ingrediente.Fecha_Vencimiento,
        };
  
        // Envío de datos al servidor
        fetch("http://localhost/ingrediente.php/?insertar=1", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(datosEnviar),
        })
          .then((respuesta) => respuesta.json())
          .then((datosRespuesta) => {
            console.log(datosRespuesta);
            window.location.href = "listaringredientes";
          })
          .catch((error) => console.error("Error:", error));
      },
    },
  };
  </script>
  