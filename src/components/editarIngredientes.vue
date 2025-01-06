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
                v-model="ingrediente.Nombre"
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
                v-model="ingrediente.Descripcion"
                placeholder="Descripción"
              />
            </div>
    
            
    
            <div class="form-group">
              <label for="fecha_creacion">Fecha de Creación</label>
              <input
                type="date"
                class="form-control"
                name="fecha_creacion"
                id="fecha_creacion"
                v-model="ingrediente.Fecha_ingreso"
              />
            </div>
    
            <div class="form-group">
              <label for="fecha_vencimiento">Fecha de Vencimiento</label>
              <input
                type="date"
                class="form-control"
                name="fecha_vencimiento"
                id="fecha_vencimiento"
                v-model="ingrediente.Fecha_vencimiento"
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
          ingrediente: {} // Objeto para almacenar los datos del pastel
        };
      },
      created() {
        this.obtenerInformacionId();
      },
      methods: {
        obtenerInformacionId() {
          // Verifica que el parámetro `id` exista.
          if (!this.$route.params.ID_ingrediente) {
            console.error("El parámetro 'id' no está definido.");
            return;
          }
    
          fetch(`http://localhost/ingrediente.php/?consultar=${this.$route.params.ID_ingrediente}`)
            .then((respuesta) => {
              if (!respuesta.ok) {
                throw new Error("Error en la respuesta de la API.");
              }
              return respuesta.json();
            })
            .then((datosRespuesta) => {
              if (datosRespuesta && datosRespuesta.length > 0) {
                this.ingrediente = datosRespuesta[0];
              } else {
                console.error(
                  "No se encontraron datos para el pastel con ID:",
                  this.$route.params.ID_ingrediente
                );
              }
            })
            .catch((error) => {
              console.error("Error al obtener la información del pastel:", error);
            });
        },
    
        actualizarRegistro() {
      const datosEnviar = {
        id: this.$route.params.ID_ingrediente, // ID del pastel obtenido de los parámetros de la ruta
        nombre: this.ingrediente.Nombre,
        descripcion: this.ingrediente.Descripcion,
        
        fecha_ingreso: this.ingrediente.Fecha_ingreso,
        fecha_vencimiento: this.ingrediente.Fecha_vencimiento,
      };
    
      fetch("http://localhost/ingrediente.php/?actualizar", {
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
            this.$router.push({ name: "listarIngredientes" });
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
    