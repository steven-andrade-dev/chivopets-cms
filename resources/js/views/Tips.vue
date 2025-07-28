<script setup>
import Sidebar from '../components/Sidebar.vue'
import Navbar from '../components/Navbar.vue'
import TableData from '../components/TableData.vue'
import { ref } from 'vue'
const tips = ref([
    {
        id: 1,
        name: 'Tips 1',
        slug: 'tips-1',
    },
    {
        id: 2,  
        name: 'Tips 2',
        slug: 'tips-2',
    },
    {
        id: 3,
        name: 'Tips 3',
        slug: 'tips-3',
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
                    <h1>Tips</h1>
                    <TableData :data="tips" />


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