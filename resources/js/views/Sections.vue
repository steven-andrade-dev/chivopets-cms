<script setup>
import Sidebar from '../components/Sidebar.vue'
import Navbar from '../components/Navbar.vue'
import { httpRequest } from '../utils/global-request'
import { ref, onMounted } from 'vue'
import TableData from '../components/TableData.vue'
import Breadcrumb from "@/components/Breadcrumb.vue";

const sections = ref([])

const getSections = async () => {
  try {
    const response = await httpRequest({
      url: '/sections',
      method: 'GET',
    })
    sections.value = response.data
    sections.value.son = 'content'
  } catch (err) {
    console.error(err)
  }
}

const breadcrumbItems = ref([
  { label: "Secciones", href: "/sections" }
]);


onMounted(() => {
  getSections()
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
                    <h1>Secciones</h1>
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
<
