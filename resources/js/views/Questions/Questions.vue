<script setup>
import Sidebar from '../../components/Sidebar.vue'
import Navbar from '../../components/Navbar.vue'
import TableData from '../../components/TableData.vue'
import { ref, onMounted } from 'vue'
import { httpRequest } from '../../utils/global-request'
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import Swal from 'sweetalert2';
const questions = ref([])
const showModal = ref(false)
const question = ref("")
const answer = ref("")

const getQuestions = async () => {
  try {
    const response = await httpRequest({
      url: `/faq`,
      method: 'GET',
    })
    questions.value = response.data
    questions.value.son = 'edit-question'
  } catch (err) {
    console.error(err)
  }
}

const saveQuestion = async () => {
  const data = {
    question: question.value,
    answer: answer.value,
  }
  const response = await httpRequest({
    url: `/faq`,
    method: 'POST',
    data: data,
  })
  console.log(response)
  if(response.success){
    Swal.fire({
      title: 'Pregunta agregada',
      text: 'La pregunta ha sido agregada correctamente',
      icon: 'success',
    })
  }else{
    Swal.fire({
      title: 'Error',
      text: 'La pregunta no ha sido agregada correctamente',
      icon: 'error',
    })
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

          <div class="mb-3">
            <button class="btn btn-success" @click="showModal = true">
              <i class="bi bi-plus"></i> Agregar
            </button>
          </div>

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

  <div v-if="showModal" class="modal fade show d-block" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Agregar Pregunta</h5>
          <button type="button" class="close" @click="showModal = false">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group mb-4 position-relative">
              <label class="form-label">Pregunta</label>
              <div class="input-group">
                <span class="input-group-text bg-dark text-white border-0">
                  <i class="bi bi-person-fill"></i>
                </span>
                <input v-model="question" type="text"
                  class="form-control form-control-lg rounded-end border-0 shadow-sm" placeholder="Pregunta" />
              </div>
            </div>
            <div class="form-group">
                        <label for="answer" class="label">Respuesta</label>
                        <quill-editor ref="editorRef" 
                            theme="snow" 
                            contentType="html"
                            placeholder="Ingrese la respuesta"
                            v-model:content="answer" />
            </div>


          </form>
        </div>
        <div class="modal-footer d-flex justify-content-between align-items-center">
          <div class="flex-shrink-0">

          </div>
          <div class="">
            <button class="btn  me-2" @click="showModal = false">Cancelar</button>
            <button class="btn btn-primary btn-glow" @click="saveQuestion">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.modal {
  display: block;
  background-color: rgba(0, 0, 0, 0.5);
  overflow-y: auto;
}

.btncancel {
  border: #aaa
}

.modal-dialog {
  margin-top: 10%;
}

body.modal-open {
  overflow: hidden;
}

.modal-content {
  background: #ffffff;
  color: #171616;
  border-radius: 1rem;
  border: none;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
}

.modal-header {
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.modal-footer {
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}

</style>