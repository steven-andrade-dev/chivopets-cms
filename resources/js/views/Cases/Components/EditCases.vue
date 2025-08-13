<script setup>
import { ref, onMounted, nextTick } from 'vue'
import { useRoute } from 'vue-router'
import Sidebar from '../../../components/Sidebar.vue'
import Navbar from '../../../components/Navbar.vue'
import Breadcrumb from '@/components/Breadcrumb.vue'
import draggable from 'vuedraggable'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'
import { httpRequest } from '../../../utils/global-request'

// route / id del caso
const route = useRoute()
const caseId = Number(route.params.id)

// estado principal
const data = ref({})              
const descriptionList = ref([])      

const showDescModal = ref(false)
const editingIndex = ref(-1)         
const form = ref({ id: null, etiqueta: '', description: '', id_locale: null, id_case: caseId })

// breadcrumb
const breadcrumbItems = ref([
  { label: 'Casos', href: '/cases' },
  { label: 'Editar Caso', href: `/edit-case/${caseId}` }
])

const getCase = async () => {
  try {
    const res = await httpRequest({ url: `/cases/${caseId}`, method: 'GET' })
    const payload = res.data?.data ?? res.data ?? {}
    data.value = payload

    descriptionList.value = (payload?.description_cases ?? [])
      .map(d => ({
        id: d.id,
        etiqueta: d.etiqueta || '',
        description: d.description || '',
        order: d.order ?? 0,
        id_locale: d.id_locale ?? payload.id_locale ?? null,
        id_case: d.id_case ?? caseId
      }))
      .sort((a, b) => (a.order ?? 0) - (b.order ?? 0) || (a.id ?? 0) - (b.id ?? 0))
  } catch (e) {
    console.error('Error cargando caso:', e)
  }
}

// --- Guardar datos generales del caso ---
const saveCase = async () => {
  try {
    await httpRequest({
      url: `/cases/${caseId}`,
      method: 'PUT',
      data: {
        image: data.value.image,
        image_author: data.value.image_author,
        author: data.value.author,
        area: data.value.area,
        name: data.value.name,
        introduction: data.value.introduction,
        date: data.value.date,
        text_button: data.value.text_button,
        id_locale: data.value.id_locale
      }
    })
    alert('Caso actualizado correctamente')
  } catch (e) {
    console.error('Error actualizando caso:', e)
    alert('No se pudo actualizar el caso')
  }
}

// --- Eliminar case completo ---
const deleteCase = async () => {
  if (!confirm('¿Eliminar este caso completo?')) return
  try {
    await httpRequest({ url: `/cases/${caseId}`, method: 'DELETE' })
    alert('Caso eliminado correctamente')
  } catch (e) {
    console.error('Error eliminando caso:', e)
    alert('No se pudo eliminar el caso')
  }
}

// --- Abrir modal (crear o editar) ---
const openDesc = (index = -1) => {
  editingIndex.value = index
  if (index === -1) {
    form.value = {
      id: null,
      etiqueta: '',
      description: '',
      id_locale: data.value.id_locale ?? 1,
      id_case: caseId
    }
  } else {
    const d = descriptionList.value[index]
    form.value = {
      id: d.id,
      etiqueta: d.etiqueta,
      description: d.description,
      id_locale: d.id_locale ?? data.value.id_locale ?? 1,
      id_case: caseId
    }
  }
  showDescModal.value = true
  nextTick() 
}

const closeDesc = () => { showDescModal.value = false }

const saveDesc = async () => {
  try {
    if (!form.value.id) {
      // crear
      const nextOrder = descriptionList.value.length
      const res = await httpRequest({
        url: `/description-cases`,
        method: 'POST',
        data: {
          id_case: caseId,
          etiqueta: form.value.etiqueta || '',
          description: form.value.description || '',
          order: nextOrder,
          id_locale: form.value.id_locale ?? data.value.id_locale ?? 1
        }
      })
      const created = res.data?.data ?? res.data
      descriptionList.value.push({
        id: created?.id ?? Date.now(),
        etiqueta: created?.etiqueta ?? form.value.etiqueta,
        description: created?.description ?? form.value.description,
        order: created?.order ?? nextOrder,
        id_locale: created?.id_locale ?? form.value.id_locale ?? null,
        id_case: created?.id_case ?? caseId
      })
    } else {
      // actualizar
      const idx = editingIndex.value
      const d = descriptionList.value[idx]
      await httpRequest({
        url: `/description-cases/${form.value.id}`,
        method: 'PUT',
        data: {
          etiqueta: form.value.etiqueta || '',
          description: form.value.description || '',
          id_locale: form.value.id_locale ?? d.id_locale
        }
      })
      d.etiqueta = form.value.etiqueta || ''
      d.description = form.value.description || ''
      d.id_locale = form.value.id_locale ?? d.id_locale
    }
    showDescModal.value = false
  } catch (e) {
    console.error('Error guardando descripción:', e)
    alert('No se pudo guardar la descripción')
  }
}

// --- Eliminar descripción ---
const deleteDescription = async (id) => {
  if (!confirm('¿Eliminar esta descripción?')) return
  try {
    await httpRequest({ url: `/description-cases/${id}`, method: 'DELETE' })
    descriptionList.value = descriptionList.value.filter(d => d.id !== id)
    await persistOrder()
  } catch (e) {
    console.error('Error al eliminar descripción:', e)
    alert('No se pudo eliminar la descripción')
  }
}

// --- Drag & drop: persistir nuevo orden ---
const onDragEnd = async () => {
  descriptionList.value.forEach((d, i) => { d.order = i })
  await persistOrder()
}

const persistOrder = async () => {
  try {
    await httpRequest({
      url: `/description-cases/reorder`,
      method: 'POST',
      data: {
        orders: descriptionList.value.map(d => ({ id: d.id, order: d.order }))
      }
    })
  } catch (e) {
    console.error('Error actualizando orden:', e)
    alert('No se pudo actualizar el orden')
  }
}

onMounted(getCase)
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
                <form @submit.prevent>
                  <!-- Título -->
                  <div class="form-group">
                    <label class="form-label fw-bold">Título</label>
                    <input type="text" class="form-control" v-model="data.name" placeholder="Ingrese el título" />
                  </div>

                  <!-- Imagen principal -->
                  <div class="form-group">
                    <label class="form-label">Imagen principal</label>
                    <input type="text" v-model="data.image" class="form-control" />
                  </div>

                  <!-- Autor -->
                  <div class="form-group">
                    <label class="form-label">Imagen del autor</label>
                    <input type="text" v-model="data.image_author" class="form-control" />
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

                  <!-- DESCRIPCIONES -->
                  <div class="form-group">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <label class="form-label m-0">Bloques de descripciones</label>
                      <div class="d-flex gap-2">
                      <button type="button" class="btn btn-success btn-sm" @click="openDesc(-1)">
                        Agregar descripción
                      </button>
                      </div>
                    </div>

                    <draggable
                      v-model="descriptionList"
                      item-key="id"
                      class="list-group"
                      @end="onDragEnd"
                    >
                      <template #item="{ element, index }">
                        <div class="list-group-item" @dblclick="openDesc(index)">
                          <div class="d-flex w-100 justify-content-between align-items-center">
                            <strong class="me-3">{{ element.etiqueta || 'Sin etiqueta' }}</strong>
                            <div class="d-flex gap-2">
                              <button type="button" class="btn btn-outline-primary btn-sm" @click="openDesc(index)">
                                Editar
                              </button>
                              <button type="button" class="btn btn-outline-danger btn-sm" @click="deleteDescription(element.id)">
                                Eliminar
                              </button>
                            </div>
                          </div>
                          <div class="mt-2 text-muted small" v-html="element.description"></div>
                        </div>
                      </template>
                    </draggable>
                  </div>

                  <hr />

                  <div class="actions mt-3">
                    <button type="button" class="btn btn-danger" @click="deleteCase">Eliminar</button>
                    <button type="button" class="btn btn-primary" @click="saveCase">Guardar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- MODAL -->
          <div v-if="showDescModal" class="modal-backdrop">
            <div class="modal-content">
              <h5 class="mb-3">{{ form.id ? 'Editar descripción' : 'Agregar descripción' }}</h5>

              <div class="mb-3">
                <label class="form-label">Etiqueta</label>
                <input type="text" class="form-control" v-model="form.etiqueta" placeholder="Ej: Introducción, Resultados, etc." />
              </div>

              <div class="mb-3">
                <label class="form-label">Contenido</label>
                <QuillEditor v-model:content="form.description" content-type="html" theme="snow" class="editor-box" />
              </div>

              <div class="text-end">
                <button class="btn btn-secondary me-2" type="button" @click="closeDesc">Cancelar</button>
                <button class="btn btn-primary" type="button" @click="saveDesc">Guardar</button>
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
.card { border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,.05); }
.card-header { background: #f8f9fa; border-bottom: 1px solid #e5e7eb; padding: 1rem; }
.form-group { margin-bottom: 1rem; }
input, textarea { background-color: #fff !important; }
.actions { display: flex; justify-content: flex-end; gap: 10px; }
.list-group { border: 1px solid #ccc; padding: 10px; border-radius: 8px; }
.list-group-item { padding: 10px; background: #f9fafb; margin-bottom: 8px; border-radius: 8px; cursor: grab; }
.modal-backdrop { position: fixed; inset: 0; background: rgba(0,0,0,.5); display: flex; align-items: center; justify-content: center; z-index: 1050; }
.modal-content { background: #fff; padding: 20px; border-radius: 10px; width: 720px; max-width: 95%; }
.editor-box { background: #fff; }
</style>
