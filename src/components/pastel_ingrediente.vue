<template>
    <div class="combo-container">
      <!-- Combo box de Pasteles -->
      <label for="pasteles" class="combo-label">Selecciona un pastel:</label>
      <select id="pasteles" v-model="selectedPastel" class="combo-box">
        <option value="" disabled>Seleccione una opción</option>
        <option
          v-for="pastel in pasteles"
          :key="pastel.ID_pastel"
          :value="pastel.ID_pastel"
        >
          {{ pastel.Nombre }}
        </option>
      </select>
      <p v-if="selectedPastel">Pastel seleccionado: {{ getPastelName(selectedPastel) }}</p>
  
      <!-- Combo box de Ingredientes -->
      <label for="ingredientes" class="combo-label">Selecciona un ingrediente:</label>
      <select id="ingredientes" v-model="selectedIngrediente" class="combo-box">
        <option value="" disabled>Seleccione una opción</option>
        <option
          v-for="ingrediente in ingredientes"
          :key="ingrediente.ID_ingrediente"
          :value="ingrediente.ID_ingrediente"
        >
          {{ ingrediente.Nombre }}
        </option>
      </select>
      <p v-if="selectedIngrediente">
        Ingrediente seleccionado: {{ getIngredienteName(selectedIngrediente) }}
      </p>
  
      <!-- Botones -->
      <div class="button-group">
        <button @click="agregarPastelIngrediente" class="btn btn-success">Agregar</button>
        <router-link :to="{ name: 'Listar' }" class="btn btn-warning">Pasteles</router-link>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        pasteles: [],
        selectedPastel: "",
  
        ingredientes: [],
        selectedIngrediente: "",
      };
    },
    mounted() {
      this.fetchPasteles();
      this.fetchIngredientes();
      this.agregarPastelIngrediente();
    },
    methods: {
      async fetchPasteles() {
        try {
          const response = await fetch("http://localhost/obtenerPasteles.php");
          if (!response.ok) {
            throw new Error("Error al cargar los pasteles");
          }
          this.pasteles = await response.json();
        } catch (error) {
          console.error("Error:", error);
        }
      },
      async fetchIngredientes() {
        try {
          const response = await fetch("http://localhost/cargarIngredientes.php");
          if (!response.ok) {
            throw new Error("Error al cargar los ingredientes");
          }
          this.ingredientes = await response.json();
        } catch (error) {
          console.error("Error:", error);
        }
      },
      getPastelName(id) {
        const pastel = this.pasteles.find((item) => item.ID_pastel === id);
        return pastel ? pastel.Nombre : "N/A";
      },
      getIngredienteName(id) {
        const ingrediente = this.ingredientes.find(
          (item) => item.ID_ingrediente === id
        );
        return ingrediente ? ingrediente.Nombre : "N/A";
      },


     async agregarPastelIngrediente() {
  if (!this.selectedPastel || !this.selectedIngrediente) {
    alert("Debe seleccionar un pastel y un ingrediente.");
    return;
  }

  try {
    const response = await fetch("http://localhost/agregarPastelIngredientes.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        ID_pastel: this.selectedPastel,
        ID_ingrediente: this.selectedIngrediente,
      }),
    });

    // Manejo de errores HTTP
    if (!response.ok) {
      const errorText = await response.text(); // Leer respuesta en texto
      console.error("Error del servidor:", errorText);
      throw new Error("Error al agregar el pastel con ingrediente. Código: " + response.status);
    }

    const result = await response.json();

    // Validar respuesta del servidor
    if (result.success) {
      alert("Pastel e ingrediente agregados exitosamente.");
      // Resetear selección
      this.selectedPastel = "";
      this.selectedIngrediente = "";
    } else {
      alert("Error: " + (result.message || "Ocurrió un problema desconocido."));
    }
  } catch (error) {
    console.error("Error:", error);
    alert("Ocurrió un error al intentar agregar los datos. Por favor, revise la consola para más detalles.");
  }
}


    },
  };
  </script>
  
  <style scoped>
  .combo-container {
    display: flex;
    flex-direction: column;
    max-width: 400px;
    margin: 20px auto;
    font-family: Arial, sans-serif;
  }
  
  .combo-label {
    font-size: 16px;
    margin: 10px 0 5px;
    font-weight: bold;
  }
  
  .combo-box {
    width: 100%;
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  
  .button-group {
    display: flex;
    gap: 10px;
    margin-top: 20px;
  }
  
  .btn {
    padding: 10px 15px;
    font-size: 14px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  .btn-success {
    background-color: #28a745;
    color: #fff;
  }
  
  .btn-warning {
    background-color: #ffc107;
    color: #fff;
    text-decoration: none;
    text-align: center;
  }
  </style>
  
  
  <style scoped>
  
  .combo-container {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  max-width: 300px;
  margin: 20px auto;
  font-family: Arial, sans-serif;
}

/* Etiqueta del combo box */
.combo-label {
  font-size: 16px;
  margin-bottom: 8px;
  font-weight: bold;
  color: #333;
}

/* Combo box (select) */
.combo-box {
  width: 100%;
  padding: 8px 12px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #f9f9f9;
  color: #333;
  cursor: pointer;
}

/* Cambiar el color de fondo al seleccionar */
.combo-box:focus {
  outline: none;
  border-color: #007bff;
  background-color: #fff;
}

/* Mensaje de selección */
.combo-result {
  margin-top: 12px;
  font-size: 14px;
  color: #555;
}   
  </style>
  