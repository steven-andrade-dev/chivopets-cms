<script setup>
import Navbar from "@/components/Navbar.vue"
import Sidebar from "@/components/Sidebar.vue"
import Breadcrumb from "@/components/Breadcrumb.vue"
import { ref, onMounted } from "vue"
import { httpRequest } from "@/utils/global-request"
import Swal from "sweetalert2"
import { QuillEditor } from "@vueup/vue-quill"
import "@vueup/vue-quill/dist/vue-quill.snow.css"
import InputComponent from "@/components/InputComponent.vue"
import SelectComponent from "@/components/SelectComponent.vue"

const breadcrumbItems = ref([
  { label: "Casos", href: "/cases" },
  { label: "Crear Caso", href: "/create-case" }
])

const locales = ref([])
const selectedCase = ref({})

// cargar idiomas
const getLocales = async () => {
  try {
    const res = await httpRequest({ url: "/locales", method: "GET" })
    locales.value = res.data?.data ?? res.data ?? []
  } catch (e) {
    console.error("Error cargando idiomas:", e)
  }
}

const openCreateCase = () => {
  selectedCase.value = {}
}

// guardar caso
const saveCase = async () => {
  try {
    const { contenidoHtml, ...rest } = selectedCase.value
    const resCase = await httpRequest({
      url: "/cases",
      method: "POST",
      data: { ...rest, id_locale: selectedCase.value.id_locale }
    })

    const created = resCase?.data?.data ?? resCase?.data
    if (!created?.id) throw new Error("No se recibió el ID del caso creado.")

    const html = String(contenidoHtml || "").trim()
    if (html) {
      await httpRequest({
        url: "/description-cases",
        method: "POST",
        data: {
          id_case: created.id,
          description: html,
          order: 0,
          id_locale: created.id_locale ?? selectedCase.value.id_locale
        }
      })
    }

    await Swal.fire({
      icon: "success",
      title: "Listo",
      text: "Caso creado correctamente.",
      timer: 1600,
      showConfirmButton: false
    })

    // reinicia el form para poder crear otro
    openCreateCase()
  } catch (error) {
    console.error("Error al guardar caso:", error)
    Swal.fire({
      icon: "error",
      title: "Error",
      text: error?.response?.data?.message ?? error?.message ?? "No se pudo guardar el caso."
    })
  }
}

onMounted(() => {
  getLocales()
  openCreateCase() 
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
                  <div class="grid gap-3">
                    <InputComponent label="Título" v-model="selectedCase.name" placeholder="Ingrese el título" />
                    <InputComponent label="Imagen principal (URL)" v-model="selectedCase.image" placeholder="https://..." />
                    <InputComponent label="Imagen del autor (URL)" v-model="selectedCase.image_author" placeholder="https://..." />
                    <InputComponent label="Nombre del autor" v-model="selectedCase.author" placeholder="Ingrese el autor" />
                    <InputComponent label="Área" v-model="selectedCase.area" placeholder="Ingrese el área" />
                    <InputComponent label="Texto Boton" v-model="selectedCase.text_button" placeholder="Texto boton" />

                    <div class="form-group">
                      <InputComponent label="Introducción" v-model="selectedCase.introduction" rows="3" placeholder="Escriba la introducción" />
                    </div>

                    <SelectComponent
                      label="Idioma"
                      icon="bi bi-translate"
                      v-model="selectedCase.id_locale"
                      :options="locales"
                      placeholder="🌐 Selecciona un idioma"
                      required
                    />
                  </div>

                  <div class="form-group mt-3">
                    <label class="form-label fw-bold">Bloque Principal</label>
                    <QuillEditor theme="snow" contentType="html" v-model:content="selectedCase.contenidoHtml"/>
                  </div>

                  <div class="mt-3">
                    <button type="submit" class="btn btn-primary" @click="saveCase">Guardar</button>
                  </div>
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
