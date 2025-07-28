<script setup>
import Sidebar from '../components/Sidebar.vue'
import Navbar from '../components/Navbar.vue'
import TableData from '../components/TableData.vue'
import { ref } from 'vue'
const cases = ref([
    {
        id: 1,
        name: 'Caso 1',
        slug: 'caso-1',
    },
    {
        id: 2,
        name: 'Caso 2',
        slug: 'caso-2',
    },
    {
        id: 3,
        name: 'Caso 3',
        slug: 'caso-3',
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
                    <h1>Casos</h1>
                    <TableData :data="cases" />


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