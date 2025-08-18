<script setup>
import Sidebar from '../../components/Sidebar.vue'
import Navbar from '../../components/Navbar.vue'
import { httpRequest } from '../../utils/global-request'
import { ref, onMounted } from 'vue'
import TableData from './Components/TableTips.vue'
import Breadcrumb from "@/components/Breadcrumb.vue";

const breadcrumbItems = ref([
  { label: "Tips", href: "/tips" }
]);

const tips = ref([])           
const pagination = ref({}) 

const getTips = async (page = 1) => {
  try {
    const idLanguage = localStorage.getItem('idioma');
    const response = await httpRequest({
      url: `/tips?idLanguage=${idLanguage}&page=${page}`,   
      method: 'GET',
    })

    tips.value = response.data.data
    pagination.value = response.data

  } catch (err) {
    console.error(err)
  }
}

onMounted(() => {
  getTips()
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
          <h1>Tips</h1>
          <TableData :data="tips" />

          <div class="row">
            <div class="col-md-12">
              <PaginationComponent
                :pagination="pagination"
                @page-change="getTips"
              />
            </div>
          </div>
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
