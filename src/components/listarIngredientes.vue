<template>

    <div class="container">
        <div class="text-center">
            <h1 > LISTA DE INGREDIENTES </h1>
        </div>
        <div>
                <router-link to="/ingresaringredientes" class="btn btn-info">AGREGAR NUEVO INGREDIENTE</router-link>
           
        </div>

        <div>

            <div class="card">
                <div class="card-header text-center">
                    Ingredientes
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="table-warning text-center">
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>DESCRIPCIÓN</th>
        
        <th>FECHA DE CREACIÓN</th>
        <th>FECHA DE VENCIMIENTO</th>
        <th>ACCIONES</th>
    </tr>
</thead>

                        <tbody>

                            <tr v-for="ingrediente in ingredientes" :key="ingrediente.ID_ingrediente">
                                <td>{{ ingrediente.ID_ingrediente }}</td>
                                <td>{{ ingrediente.Nombre }}</td>
                                <td>{{ ingrediente.Descripcion }}</td>
                                
                                <td>{{ ingrediente.Fecha_ingreso }}</td>
                                <td>{{ ingrediente.Fecha_vencimiento }}</td>
                                <td>

                                    <div class="btn-group" role="group" aria-label="">
                                    <button 
                                        class="btn btn-warning"
                                        v-on:click="obtenerDetalles(ingrediente.ID_ingrediente)"
                                        title="Ver detalles">
                                         <i class="fa fa-eye"></i> <!-- Font Awesome -->
                                          <!-- <i class="bi bi-eye"></i> Bootstrap Icons -->
                                        </button>

                                        <router-link :to="{name:'editarIngredientes',params:{ID_ingrediente:ingrediente.ID_ingrediente}}" class="btn btn-primary">Editar</router-link>
                                       
                                        <button type="button" v-on:click="borrarRegistro(ingrediente.ID_ingrediente)" class="btn btn-danger">Eliminar</button>
                                        
                                    </div>

                                    
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                
                </div>
            </div>
        </div>

        <div >

            <div></div>
            <div></div>
            <div></div>
            
            
            

        </div>



    </div>
</template>


<script>
export default {


    data(){


        return{
            ingredientes:[]
        }


    },


    created:function(){

        this.consultarRegistro();


    },

    methods:{


        consultarRegistro(){

            fetch('http://localhost/ingrediente.php')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)

                this.ingredientes=[]

                if (typeof datosRespuesta[0].success==='undefined')
                 {
                    this.ingredientes=datosRespuesta;
                }
            })


            .catch(console.log)
        },
        borrarRegistro(ID_ingrediente){

            fetch('http://localhost/ingrediente.php/?borrar='+ID_ingrediente)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)

                window.location.href="listaringredientes"
               
            })


            .catch(console.log)

            console.log(ID_ingrediente);
        },
        obtenerDetalles() {
      const ID_ingrediente= this.$route.params.ID_ingrediente;
      fetch(`http://localhost/ingrediente.php/?verDetalles=${ID_ingrediente}`)
        .then((respuesta) => respuesta.json())
        .then((datos) => {
          this.ingrediente = datos;
        })
        .catch((error) => console.error("Error al obtener los detalles:", error));
    }



    }

}
</script>