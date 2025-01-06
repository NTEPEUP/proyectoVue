<template>

    <div class="container">
        <div class="text-center">
            <h1 > LISTA DE PASTELES</h1>
        </div>

        <div>
                <router-link to="/crear" class="btn btn-info">AGREGAR NUEVO PASTEL</router-link>
           
        </div>
       

        <div>

            <div class="card">
                <div class="card-header text-center">
                    Pasteles
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

                            <tr v-for="pastel in pasteles" :key="pastel.ID_pastel">
                                <td>{{ pastel.ID_pastel }}</td>
                                <td>{{ pastel.Nombre }}</td>
                                <td>{{ pastel.Descripcion }}</td>
                                
                                <td>{{ pastel.Fecha_creacion }}</td>
                                <td>{{ pastel.Fecha_vencimiento }}</td>
                                <td>

                                    <div class="btn-group" role="group" aria-label="">
                                    <button 
                                        class="btn btn-warning"
                                        v-on:click="obtenerDetalles(pastel.ID_pastel)"
                                        title="Ver detalles">
                                         <i class="fa fa-eye"></i> <!-- Font Awesome -->
                                          <!-- <i class="bi bi-eye"></i> Bootstrap Icons -->
                                        </button>

                                        <router-link :to="{name:'Editar',params:{ID_pastel:pastel.ID_pastel}}" class="btn btn-primary">Editar</router-link>
                                       
                                        <button type="button" v-on:click="borrarEmpleado(pastel.ID_pastel)" class="btn btn-danger">Eliminar</button>
                                        
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
            pasteles:[]
        }


    },


    created:function(){

        this.consultarEmpleados();


    },

    methods:{


        consultarEmpleados(){

            fetch('http://localhost/index.php')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)

                this.pasteles=[]

                if (typeof datosRespuesta[0].success==='undefined')
                 {
                    this.pasteles=datosRespuesta;
                }
            })


            .catch(console.log)
        },
        borrarEmpleado(ID_pastel){

            fetch('http://localhost/index.php/?borrar='+ID_pastel)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)

                window.location.href="listar"
               
            })


            .catch(console.log)

            console.log(ID_pastel);
        },
        obtenerDetalles() {
      const ID_pastel = this.$route.params.ID_pastel;
      fetch(`http://localhost/index.php/?verDetalles=${ID_pastel}`)
        .then((respuesta) => respuesta.json())
        .then((datos) => {
          this.pastel = datos;
        })
        .catch((error) => console.error("Error al obtener los detalles:", error));
    }



    }

}
</script>