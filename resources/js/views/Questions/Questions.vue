<script setup>
import Sidebar from '../../components/Sidebar.vue'
import Navbar from '../../components/Navbar.vue'
import TableData from '../../components/TableData.vue'
import { ref, onMounted } from 'vue'
import { httpRequest } from '../../utils/global-request'

const questions = ref([])

const getQuestions = async () => {
  try {
    const response = await httpRequest({
      url: `/faq`,
      method: 'GET',
    })
    console.log(response.data)
    questions.value = response.data
    questions.value.son = 'edit-question'
  } catch (err) {
    console.error(err)
  }
}

onMounted(() => {
  getQuestions()
})
</script>
<template>
    <div id="wrapper">
        <Sidebar />
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <Navbar />
                <div class="container-fluid">
                    <h1>Preguntas</h1>
                    <TableData :data="questions" />


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