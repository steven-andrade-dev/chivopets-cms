<script setup>
import Sidebar from '../../components/Sidebar.vue'
import Navbar from '../../components/Navbar.vue'
import TableData from '../../components/TableData.vue'
import { ref } from 'vue'
const sections = ref([
    {
        id: 1,
        name: 'Contenido 1',
        slug: 'contenido-1',
    },
    {
        id: 2,
        name: 'Contenido 2',
        slug: 'contenido-2',
    },
    {
        id: 3,
        name: 'Contenido 3',
        slug: 'contenido-3',
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
                    <h1>Contenido</h1>
                    <TableData :data="sections" />


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