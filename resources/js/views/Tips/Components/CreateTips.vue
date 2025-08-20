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

const breadcrumbItems = [
  { label: "Tips", href: "/tips" },
  { label: "Crear Tip", href: "/create-tips" }
]


const selectedTips = ref({})
const locales = ref([])

// cargar idiomas
const loadLocales = async () => {
  try {
    const res = await httpRequest({ url: "/locales", method: "GET" })
    locales.value = res.data?.data ?? res.data ?? []
  } catch (e) {
    console.error("Error cargando idiomas:", e)
  }
}


const openCreateTip = () => {
  selectedTips.value = {}
}

// guardar tip
const saveTip = async () => {
  try {
    const { contenidoHtml, ...rest } = selectedTips.value
    const resTips = await httpRequest({
      url: "/tips",
      method: "POST",
      data: { ...rest, id_locale: selectedTips.value.id_locale }
    })

    const created = resTips?.data?.data ?? resTips?.data
    if (!created?.id) throw new Error("No se recibió el ID del tip creado.")

    const html = String(contenidoHtml || "").trim()
    if (html) {
      await httpRequest({
        url: "/description-tips",
        method: "POST",
        data: {
          id_tips: created.id,
          description: html,
          order: 0,
          id_locale: created.id_locale ?? selectedTips.value.id_locale
        }
      })
    }

    await Swal.fire({
      icon: "success",
      title: "Listo",
      text: "Tip creado correctamente.",
      timer: 1600,
      showConfirmButton: false
    })

    // reinicia el form para poder crear otro
    openCreateTip()
  } catch (error) {
    console.error("Error al guardar tip:", error)
    Swal.fire({
      icon: "error",
      title: "Error",
      text: error?.response?.data?.message ?? error?.message ?? "No se pudo guardar el tip."
    })
  }
}


onMounted(() => {
  loadLocales()
  openCreateTip()
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
                <h3 class="card-title mb-0">Crear Tip</h3>
              </div>

             <div class="card-body">
                  <div class="grid gap-3">
                    <InputComponent label="Título" v-model="selectedTips.name" placeholder="Ingrese el título" />
                    <InputComponent label="Imagen principal (URL)" v-model="selectedTips.image" placeholder="https://..." />
                    <InputComponent label="Imagen del autor (URL)" v-model="selectedTips.image_author" placeholder="https://..." />
                    <InputComponent label="Nombre del autor" v-model="selectedTips.author" placeholder="Ingrese el autor" />
                    <InputComponent label="Área" v-model="selectedTips.area" placeholder="Ingrese el área" />
                    <InputComponent label="Texto Boton" v-model="selectedTips.text_button" placeholder="Texto boton" />

                    <div class="form-group">
                      <InputComponent label="Introducción" v-model="selectedTips.introduction" rows="3" placeholder="Escriba la introducción" />
                    </div>

                    <SelectComponent
                      label="Idioma"
                      icon="bi bi-translate"
                      v-model="selectedTips.id_locale"
                      :options="locales"
                      placeholder="🌐 Selecciona un idioma"
                      required
                    />
                  </div>

                  <div class="form-group mt-3">
                    <label class="form-label fw-bold">Bloque Principal</label>
                    <QuillEditor theme="snow" contentType="html" v-model:content="selectedTips.contenidoHtml"/>
                  </div>

                  <div class="mt-3">
                    <button type="submit" class="btn btn-primary" @click="saveTip">Guardar</button>
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
