<script setup>
import Sidebar from '../components/Sidebar.vue'
import Navbar from '../components/Navbar.vue'
import { httpRequest } from '../utils/global-request'
import { ref, onMounted } from 'vue'
import TableData from '../components/Lenguage/TableLenguage.vue'

const locales = ref([])

const getLocales = async () => {
  try {
    const response = await httpRequest({
      url: '/locales',
      method: 'GET',
    })
    locales.value = response.data
  } catch (err) {
    console.error(err)
  }
}

onMounted(() => {
  getLocales()
})
</script>


<template>
    <div id="wrapper">
        <Sidebar />
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <Navbar />
                <div class="container-fluid">
                    <h1>Idioma</h1>
                    <TableData :data="locales" @refresh="getLocales" />
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

