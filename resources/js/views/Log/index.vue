<script setup>
import Sidebar from '../../components/Sidebar.vue'
import Navbar from '../../components/Navbar.vue'
import { httpRequest } from '../../utils/global-request'
import { ref, onMounted } from 'vue'
import TableData from './component/table.vue'
import Breadcrumb from "@/components/Breadcrumb.vue";

const logs = ref([])

const breadcrumbItems = ref([
  { label: "Log de actividades", href: "/" }
]);

const getLogs = async () => {
  try {
    const response = await httpRequest({
      url: '/logs',
      method: 'GET',
    })
    logs.value = response.data.data
  } catch (err) {
    console.error(err)
  }
}

onMounted(() => {
  getLogs()
})


</script>


<template>
    <div id="wrapper">
        <Sidebar />
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <Navbar />
                <div class="container-fluid">
                    <Breadcrumb :items="breadcrumbItems" />
                    <TableData :data="logs" @refresh="getLogs" />
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

