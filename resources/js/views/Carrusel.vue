<script setup>
import Sidebar from '../components/Sidebar.vue'
import Navbar from '../components/Navbar.vue'
import TableData from '../components/TableData.vue'
import { ref } from 'vue'
const carrusel = ref([
    {
        id: 1,
        name: 'Carrusel 1',
        slug: 'carrusel-1',
    },
    {
        id: 2,  
        name: 'Carrusel 2',
        slug: 'carrusel-2',
    },
    {
        id: 3,
        name: 'Carrusel 3',
        slug: 'carrusel-3',
    },
])
</script>
<template>
    <div id="wrapper">
        <Sidebar />
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <Navbar />
                <div class="container-fluid">
                    <h1>Carrusel</h1>
                    <TableData :data="carrusel" />


                </div>

            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Chivo Pets</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>