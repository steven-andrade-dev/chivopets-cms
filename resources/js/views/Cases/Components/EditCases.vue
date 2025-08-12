<script setup>
import Sidebar from '../../../components/Sidebar.vue'
import Navbar from '../../../components/Navbar.vue'
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import Breadcrumb from "@/components/Breadcrumb.vue"
import { QuillEditor } from "@vueup/vue-quill"
import Quill from "quill"
import draggable from "vuedraggable" // <-- Import draggable
import "@vueup/vue-quill/dist/vue-quill.snow.css"
import { httpRequest } from "../../../utils/global-request";

const route = useRoute()
const caseId = route.params.id

const data = ref({})
const contenidoHtml = ref("")
const descriptionList = ref([]) // <-- Lista para draggable
const breadcrumbItems = ref([
  { label: "Casos", href: "/cases" },
  { label: "Editar Caso", href: `/edit-case/${caseId}` }
])

const getCase = async () => {
  try {
    const response = await httpRequest({
      url: `/cases/${caseId}`,
      method: "GET"
    })

    data.value = response.data.data ?? response.data

    if (data.value.description_cases?.length) {
      descriptionList.value = data.value.description_cases
      contenidoHtml.value = data.value.description_cases[0].description
    }
  } catch (error) {
    console.error("Error cargando caso:", error)
  }
}


const Actualizarcase = async () => {
  try {
    const response = await httpRequest({
      url: `/cases/${caseId}`,
      method: "PUT",
      data: {
        ...data.value,
        description_cases: descriptionList.value,
        description: contenidoHtml.value
      }
    })

    if (response.status === 200) {
      alert("Caso actualizado correctamente")
    }
  } catch (error) {
    console.error("Error actualizando caso:", error)
  }
}






const SizeStyle = Quill.import("attributors/style/size")
SizeStyle.whitelist = ["12px", "14px", "16px", "18px", "24px", "32px", "48px", "53px"]
Quill.register(SizeStyle, true)

const globalOptions = {
  modules: { toolbar: "#custom-toolbar" },
  formats: [
    "size", "color", "bold", "italic", "underline", "strike", "blockquote", 
    "code-block", "list", "bullet", "link", "image", "video"
  ],
  theme: "snow",
}
QuillEditor.props.globalOptions.default = () => globalOptions

onMounted(() => {
  getCase()
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

          <div class="container">
            <div class="card m-3">
              <div class="card-header">
                <h3 class="card-title mb-0">Editar Caso</h3>
              </div>
              <div class="card-body">
                <form>
                  <!-- Título -->
                  <div class="form-group">
                    <label class="form-label fw-bold">Título</label>
                    <input type="text" class="form-control" v-model="data.name" placeholder="Ingrese el título" />
                  </div>

                  <!-- Imagen principal -->
                  <div class="form-group">
                    <label class="form-label">Imagen principal</label>
                    <input type="file" class="form-control" />
                  </div>

                  <!-- Autor -->
                  <div class="form-group">
                    <label class="form-label">Imagen del autor</label>
                    <input type="file" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label class="form-label">Nombre del autor</label>
                    <input type="text" class="form-control" v-model="data.author" placeholder="Ingrese el autor" />
                  </div>

                  <!-- Área -->
                  <div class="form-group">
                    <label class="form-label">Área</label>
                    <input type="text" class="form-control" v-model="data.area" placeholder="Ingrese el área" />
                  </div>

                  <!-- Introducción -->
                  <div class="form-group">
                    <label class="form-label">Introducción</label>
                    <textarea class="form-control" rows="3" v-model="data.introduction" placeholder="Escriba la introducción"></textarea>
                  </div>

                  <!-- Lista de descripciones draggable -->
                  <div class="form-group">
                    <label class="form-label">Bloques de descripción</label>
                    <draggable v-model="descriptionList" item-key="id" class="list-group">
                      <template #item="{ element }">
                        <div class="list-group-item">
                          {{ element.etiqueta || "Sin etiqueta" }}
                          <button class="btn btn-link btn-sm float-end" @click="removeDescriptionBlock(element.id)">Eliminar</button>
                          <button class="btn btn-link btn-sm float-end" @click="editDescriptionBlock(element.id)">Editar</button>
                        </div>
                      </template>
                    </draggable>
                  </div>

                  <!-- Descripción editable -->
                  <div class="form-group">
                    <label for="description" class="form-label">Descripcion Principal</label>
                    <div id="custom-toolbar">
                      <select class="ql-size">
                        <option value="12px">12 px</option>
                        <option value="14px">14 px</option>
                        <option value="16px">16 px</option>
                        <option value="18px">18 px</option>
                        <option value="24px">24 px</option>
                        <option value="32px">32 px</option>
                        <option value="48px">48 px</option>
                        <option value="53px">53 px</option>
                      </select>
                      <button class="ql-bold"></button>
                      <button class="ql-italic"></button>
                      <button class="ql-underline"></button>
                      <select class="ql-color"></select>
                      <button class="ql-list" value="ordered"></button>
                      <button class="ql-list" value="bullet"></button>
                      <button class="ql-link"></button>
                      <button class="ql-clean"></button>
                    </div>
                    <quill-editor
                      ref="editorRef"
                      theme="snow"
                      toolbar="#custom-toolbar"
                      contentType="html"
                      :global-options="globalOptions"
                      v-model:content="contenidoHtml"
                    />
                  </div>

                  <button class="btn btn-primary" @click="addDescriptionBlock">Agregar Descripcion</button>

                  <hr>

                  <div class="actions mt-3">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                    <button type="submit" class="btn btn-primary" @click="Actualizarcase">Guardar</button>
                  </div>
                </form>
              </div>
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

<style scoped>
.card {
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}
.card-header {
  background: #f8f9fa;
  border-bottom: 1px solid #e5e7eb;
  padding: 1rem;
}
.form-group {
  margin-bottom: 1rem;
}
input, textarea {
  background-color: white !important;
}
.actions {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}
.list-group {
  border: 1px solid #ccc;
  padding: 10px;
}
.list-group-item {
  padding: 8px;
  background: #f5f5f5;
  margin-bottom: 5px;
  cursor: grab;
}
</style>
