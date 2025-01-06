<template>
    <div>
      <h1>Reporte de Pasteles e Ingredientes</h1>
      <table>
        <thead>
          <tr>
            <th>Pastel</th>
            <th>Descripción</th>
            <th>Ingrediente</th>
            <th>Fecha de Ingreso</th>
            <th>Fecha de Vencimiento</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(row, index) in datos" :key="index">
            <td>{{ row.pastel }}</td>
            <td>{{ row.descripcion_pastel }}</td>
            <td>{{ row.ingrediente }}</td>
            <td>{{ row.Fecha_ingreso }}</td>
            <td>{{ row.Fecha_vencimiento }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        datos: []
      };
    },
    mounted() {
      this.cargarDatos();
    },
    methods: {
      async cargarDatos() {
        try {
          const response = await fetch('http://localhost/reportes.php');
          if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
          }
          const data = await response.json();
          this.datos = data;
        } catch (error) {
          console.error('Error al cargar los datos:', error);
        }
      }
    }
  };
  </script>
  
  <style>
  table {
    width: 100%;
    border-collapse: collapse;
  }
  thead {
    background-color: #f4f4f4;
  }
  th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }
  </style>
  