<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
</script>

<template>
  <header>
    <div class="wrapper">
      <HelloWorld msg="Bienvenido al sistema de pastelería!!!" />

      <nav>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/reporte">REPORTE</RouterLink>

        
        <router-link to="/listar">PASTEL</router-link>
        <router-link to="/pastel_ingrediente">pureba</router-link>
        <router-link to="/listaringredientes">INGREDIENTES</router-link>
       
      </nav>
      <div class="container">
    <img alt="Vue logo" class="logo animated" src="@/assets/p.png" width="600" height="400" />
  </div>

    
    </div>
  </header>

  <RouterView />
</template>

<style scoped>
header {
  line-height: 1.5;
  max-height: 100vh;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

nav {
  width: 100%;
  font-size: 12px;
  text-align: center;
  margin-top: 2rem;
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
}

nav a:first-of-type {
  border: 0;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }

  nav {
    text-align: left;
    margin-left: -1rem;
    font-size: 1rem;

    padding: 1rem 0;
    margin-top: 1rem;
  }

  .container {
  position: relative;
  width: 800px;
  height: 600px;
  border: 1px solid transparent; /* El borde es invisible */
  overflow: hidden;
}


.logo {
  position: absolute;
}

.animated {
  animation: moveAround 20s infinite;
}

@keyframes moveAround {
  0% {
    top: 0;
    left: 0;
  }
  25% {
    top: 0;
    left: calc(100% - 100px); /* Resta el ancho de la imagen */
  }
  50% {
    top: calc(100% - 100px); /* Resta la altura de la imagen */
    left: calc(100% - 100px);
  }
  75% {
    top: calc(100% - 100px);
    left: 0;
  }
  100% {
    top: 0;
    left: 0;
  }}
}
</style>
