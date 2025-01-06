import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'


import Crear from '../components/Crear.vue'
import Listar from '../components/Listar.vue'
import Editar from '../components/Editar.vue'
import ingresarIngredientes from '../components/ingresarIngredientes.vue'
import listarIngredientes from '../components/listarIngredientes.vue'
import editarIngredientes from '../components/editarIngredientes.vue'
import pastel_ingrediente from '../components/pastel_ingrediente.vue'
import reporte from '../components/reporte.vue'



const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },

    {
      path: '/crear',
      name: 'Crear',
      component: Crear
    },
    {
      path: '/editar/:ID_pastel',
      name: 'Editar',
      component: Editar
    },
    
    {
      path: '/listar',
      name: 'Listar',
      component: Listar
    },
    {
      path: '/reporte',
      name: 'reporte',
      component: reporte
    },

    {
      path: '/listaringredientes',
      name: 'listarIngredientes',
      component: listarIngredientes
    },
    {
      path: '/ingresaringredientes',
      name: 'ingresarIngredientes',
      component: ingresarIngredientes
    },
    {
      path: '/editaringredientes/:ID_ingrediente',
      name: 'editarIngredientes',
      component: editarIngredientes
    },

    {path: '/pastel_ingrediente',
      name: 'pastel_ingrediente',
      component: pastel_ingrediente

    },



    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue'),
    },
  ],
})

export default router
