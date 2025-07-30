<script setup>
import Sidebar from '../components/Sidebar.vue'
import Navbar from '../components/Navbar.vue'
import { httpRequest } from '../utils/global-request'
import { ref, onMounted } from 'vue'
import TableData from '../components/Usuario/TableUsuarios.vue'

const users = ref([])

const getUsers = async () => {
  try {
    const response = await httpRequest({
      url: '/users',
      method: 'GET',
    })
    users.value = response.data
  } catch (err) {
    console.error(err)
  }
}

onMounted(() => {
  getUsers()
})
</script>


<template>
    <div id="wrapper">
        <Sidebar />
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <Navbar />
                <div class="container-fluid">
                    <h1>Usuarios</h1>
                    <TableData :data="users" @refresh="getUsers" />
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

