<script setup>
import Sidebar from '../components/Sidebar.vue'
import Navbar from '../components/Navbar.vue'
import { httpRequest } from '../utils/global-request'
import { ref, onMounted } from 'vue'
import TableData from '../components/Usuario/TableRol.vue'

const rol = ref([])

const getRol = async () => {
  try {
    const response = await httpRequest({
      url: '/rol',
      method: 'GET',
    })
    rol.value = response.data
  } catch (err) {
    console.error(err)
  }
}

onMounted(() => {
  getRol()
})
</script>


<template>
    <div id="wrapper">
        <Sidebar />
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <Navbar />
                <div class="container-fluid">
                    <h1>Roles</h1>
                    <TableData :data="rol" @refresh="getRol" />
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

