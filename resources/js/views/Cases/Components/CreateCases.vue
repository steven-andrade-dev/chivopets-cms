<script setup lang="ts">
import Navbar from "../../../components/Navbar.vue"
import Sidebar from "../../../components/Sidebar.vue"
import Breadcrumb from "@/components/Breadcrumb.vue"

import { ref, onMounted } from "vue"
import { httpRequest } from "../../../utils/global-request"
import Swal from "sweetalert2"

import { QuillEditor } from "@vueup/vue-quill"
import "@vueup/vue-quill/dist/vue-quill.snow.css"

/* Breadcrumb */
const breadcrumbItems = ref([
  { label: "Casos", href: "/cases" },
  { label: "Crear Caso", href: "/create-case" }
])

/* Locales */
const locales = ref<any[]>([])
const getLocales = async () => {
  try {
    const res = await httpRequest({ url: "/locales", method: "GET" })
    locales.value = res.data?.data ?? res.data ?? []
  } catch (e) {
    console.error("Error cargando idiomas:", e)
  }
}

const today = new Date().toISOString().slice(0, 10) 
const form = ref({
  name: "",            
  image: "",           
  image_author: "",    
  author: "",          
  area: "",           
  introduction: "",   
  id_locale: "",       
  date: today,         
  text_button: "Descargar Informe",
  contenidoHtml: ""    
})

const saveCase = async () => {
  try {
    const { name, image, image_author, author, area, introduction, id_locale, date, text_button } = form.value
    const payloadCase = { name, image, image_author, author, area, introduction, id_locale, date, text_button }

    const resCase = await httpRequest({ url: "/cases", method: "POST", data: payloadCase })
    const created = resCase?.data?.data ?? resCase?.data

    if (!created?.id) throw new Error("No se recibió el ID del caso creado.")

    const html = String(form.value.contenidoHtml || "").trim()
    if (html.length > 0) {
      const payloadDesc = {
        id_case: created.id,
        etiqueta: "Principal",
        description: html,
        order: 0,
        id_locale: created.id_locale ?? id_locale
      }
      await httpRequest({ url: "/description-cases", method: "POST", data: payloadDesc })
    }

    await Swal.fire({ title: "Listo", text: "Caso creado correctamente.", icon: "success" })
    form.value = {
      ...form.value,
      name: "",
      image: "",
      image_author: "",
      author: "",
      area: "",
      introduction: "",
      contenidoHtml: ""
    }
  } catch (error: any) {
    console.error("Error al guardar caso:", error)
    Swal.fire({ title: "Error", text: error?.message ?? "No se pudo guardar el caso.", icon: "error" })
  }
}

onMounted(() => {
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
          <Breadcrumb :items="breadcrumbItems" />

          <div class="container">
            <div class="card m-3">
              <div class="card-header">
                <h3 class="card-title mb-0">Crear Caso</h3>
              </div>

              <div class="card-body">
                <form @submit.prevent="saveCase">
                  <div class="form-group">
                    <label class="form-label fw-bold">Título</label>
                    <input v-model="form.name" type="text" class="form-control" placeholder="Ingrese el título" />
                  </div>

                  <div class="form-group">
                    <label class="form-label">Imagen principal (URL)</label>
                    <input v-model="form.image" type="text" class="form-control" placeholder="https://..." />
                  </div>

                  <div class="form-group">
                    <label class="form-label">Imagen del autor (URL)</label>
                    <input v-model="form.image_author" type="text" class="form-control" placeholder="https://..." />
                  </div>

                  <div class="form-group">
                    <label class="form-label">Nombre del autor</label>
                    <input v-model="form.author" type="text" class="form-control" placeholder="Ingrese el autor" />
                  </div>

                  <div class="form-group">
                    <label class="form-label">Área</label>
                    <input v-model="form.area" type="text" class="form-control" placeholder="Ingrese el área" />
                  </div>

                  <div class="form-group">
                    <label class="form-label">Introducción</label>
                    <textarea v-model="form.introduction" class="form-control" rows="3" placeholder="Escriba la introducción" />
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Idioma</label>
                        <select v-model="form.id_locale" class="form-select">
                          <option disabled value="">🌐 Selecciona un idioma</option>
                          <option v-for="loc in locales" :key="loc.id" :value="loc.id">
                            {{ loc.name }}
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Fecha</label>
                        <input v-model="form.date" type="date" class="form-control" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="form-label fw-bold">Bloque Principal</label>
                    <QuillEditor
                      theme="snow"
                      contentType="html"
                      v-model:content="form.contenidoHtml"
                    />
                  </div>

                  <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
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
