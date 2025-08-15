<script setup>
import Sidebar from '../components/Sidebar.vue'
import Navbar from '../components/Navbar.vue'
import { httpRequest } from '../utils/global-request'
import { ref, onMounted } from 'vue'
import TableData from '../components/TableData.vue'
import Breadcrumb from "@/components/Breadcrumb.vue";

const sections = ref([])

const EditButton = ref('Editar')
const getSections = async () => {

const idLanguage = ref(1)
const pagination = ref({});

const getSections = async (page = 1) => {

  try {
    const response = await httpRequest({
      url: `/sections?idLanguage=${idLanguage.value}&page=${page}`,
      method: 'GET',
    })
    sections.value = response.data.data
    pagination.value = response.data;
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

                    <TableData :data="sections" EditButton="Ver contenido" />

                    <LanguageSelect
                        v-model="idLanguage"
                        id="idLanguage"
                        @change="getSections(1)"


                    />
                    <TableData :data="sections" />
                    <div class="row">
                        <div class="col-md-12">
                            <PaginationComponent
                                :pagination="pagination"
                                @page-change="getSections"
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