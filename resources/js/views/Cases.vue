<script setup>
import Sidebar from '../components/Sidebar.vue'
import Navbar from '../components/Navbar.vue'
import TableData from '../components/TableData.vue'
import { ref, onMounted } from 'vue'
import { httpRequest } from '../utils/global-request'
const cases = ref([])

const getCases = async () => {
  try {
    const response = await httpRequest({
      url: '/cases',
      method: 'GET',
    })
    cases.value = response.data
  } catch (err) {
    console.error(err)
  }
}
onMounted(() => {
  getCases()
})
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