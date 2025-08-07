<script setup lang="ts">
import Sidebar from '../components/Sidebar.vue';

</script>

<template>
    <div>
       
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <Navbar />
                <div class="container-fluid">
                    <h1>Página no encontrada</h1>
                    <p>La ruta que intentaste no existe.</p>
                    <router-link to="/">Volver al inicio</router-link>
                </div>
            </div>
        </div>
        
    </div>
  </template>