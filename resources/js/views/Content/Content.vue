<script setup>
import Sidebar from '../../components/Sidebar.vue'
import Navbar from '../../components/Navbar.vue'
import TableData from '../../components/Content/TableData.vue'
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { httpRequest } from '../../utils/global-request'
import Breadcrumb from "@/components/Breadcrumb.vue";

const breadcrumbItems = ref([
  { label: "Secciones", href: "/sections" },
  { label: "Contenido", href: "/content" }
]);

const route = useRoute()
const id = route.params.id
const content = ref([])

const pagination = ref({});

const getContent = async () => {
  try {
    const response = await httpRequest({
      url: `/content/${id}`,
      method: 'GET',
    })
    content.value = response.data.data
    pagination.value = response.data;
    content.value.son = 'edit-content'
  } catch (err) {
    console.error(err)
  }
}
onMounted(() => {
  getContent()
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
                    <h1>Contenido</h1>
                    <TableData :data="content" DetailButton="Editar" :hasEdit="false" @refresh="getContent" url="content" />

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
