<script setup>
import Sidebar from '../components/Sidebar.vue'
import Navbar from '../components/Navbar.vue'
import { httpRequest } from '../utils/global-request'
import { ref, onMounted } from 'vue'
import TableData from '../components/Main/TableMain.vue'

const main = ref([])

const getMain = async () => {
  try {
    const response = await httpRequest({
      url: '/mainlocale',
      method: 'GET',
    })
    main.value = response.data
  } catch (err) {
    console.error(err)
  }
}
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
  getMain()
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
                    <h1>Menu</h1>
                    <TableData :data="main" :locales="locales" @refresh="getMain" />
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

