<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import Sidebar from '../../../components/Sidebar.vue'
import Navbar from '../../../components/Navbar.vue'
import Breadcrumb from '@/components/Breadcrumb.vue'
import draggable from 'vuedraggable'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'
import { httpRequest } from '../../../utils/global-request'
import InputComponent from '@/components/InputComponent.vue'
import ModalComponent from '@/components/ModalComponent.vue'
import Swal from 'sweetalert2'
import DescriptionItem from '@/components/DescriptionItem.vue'



const route = useRoute()
const tipsId = Number(route.params.id)

const data = ref({})
const descriptionList = ref([])
const showDescModal = ref(false)
const editingIndex = ref(-1)
const form = ref({ description: '', id_locale: '', id_tips: tipsId })

const breadcrumbItems = ref([
  { label: 'Tips', href: '/tips' },
  { label: 'Editar Tip', href: `/edit-tips/${tipsId}` }
])

const normalizeOrders = () => {
  descriptionList.value.sort((a, b) => (a.order - b.order) || (a.id - b.id))
  for (let i = 0; i < descriptionList.value.length; i++) {
    descriptionList.value[i].order = i
  }
}


const persistOrder = async () => {
  try {
    await httpRequest({
      url: '/description-tips/reorder',
      method: 'POST',
      data: { orders: descriptionList.value.map(d => ({ id: d.id, order: d.order })) }
    })
  } catch (e) {
    console.error('Error actualizando orden:', e)
    Swal.fire('Error', 'No se pudo actualizar el orden', 'error')
  }
}


/* ===== Cargar tip con descripciones ===== */
const getTips = async () => {
  try {
    const res = await httpRequest({ url: '/tips/' + tipsId, method: 'GET' })
    const payload = res.data && typeof res.data === 'object' && 'data' in res.data ? res.data.data : res.data
    
    data.value = payload
    const arr = payload && payload.description_tips ? payload.description_tips : []
    descriptionList.value = arr.map(d => ({
      id: d.id,
      description: d.description,
      order: typeof d.order === 'number' ? d.order : 0,
      id_locale: d.id_locale,
      id_tips: tipsId   
    }))
    
    normalizeOrders()
  } catch (e) {
    console.error('Error cargando tip:', e)
    Swal.fire('Error', 'No se pudo cargar el tip', 'error')
  }
}

const savetip = async () => {
  try {
    await httpRequest({
      url: '/tips/' + tipsId,
      method: 'PUT',
      data: {
        image: data.value.image,
        image_author: data.value.image_author,
        author: data.value.author,
        area: data.value.area,
        name: data.value.name,
        introduction: data.value.introduction,
        text_button: data.value.text_button,
        id_locale: data.value.id_locale
      }
    })
    Swal.fire({ icon: 'success', title: 'Guardado', text: 'Tip actualizado correctamente', timer: 1600, showConfirmButton: false })
  } catch (e) {
    console.error('Error actualizando tip:', e)
    Swal.fire('Error', 'No se pudo actualizar el tip', 'error')
  }
}

const deleteTip = async () => {
  const r = await Swal.fire({
    title: '¿Eliminar este tip?',
    text: 'Esta acción no se puede deshacer.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Eliminar',
    cancelButtonText: 'Cancelar'
  })
  if (!r.isConfirmed) return
  try {
    await httpRequest({ url: '/tips/' + tipsId, method: 'DELETE' })
    Swal.fire({ icon: 'success', title: 'Eliminado', text: 'Tip eliminado correctamente', timer: 1500, showConfirmButton: false })
  } catch (e) {
    console.error('Error eliminando tip:', e)
    Swal.fire('Error', 'No se pudo eliminar el tip', 'error')
  }
}

/* ===== Modal descripción (sin defaults) ===== */
const openDesc = (index = -1) => {
  editingIndex.value = index
  if (index === -1) {
    form.value = {
      description: '',
      id_locale: String(data.value.id_locale),
      id_tips: tipsId
    }
  } else {
    const d = descriptionList.value[index]
    form.value = {
      description: d.description,
      id_locale: String(d.id_locale),
      id_tips: tipsId
    }
  }
  showDescModal.value = true
  document.body.classList.add('modal-open')
}


const closeDesc = () => {
  showDescModal.value = false
  document.body.classList.remove('modal-open')
}

/* ===== Crear/Actualizar descripción (pocas vars) ===== */
const saveDesc = async () => {
  try {
    if (editingIndex.value === -1) {
      const res = await httpRequest({
        url: '/description-tips',
        method: 'POST',
        data: {
          id_tips: form.value.id_tips,
          description: form.value.description,
          order: descriptionList.value.length, 
          id_locale: form.value.id_locale
        }
      })
      /* ===== Trae la vista de regreso con lo que se cambio ===== */
      const created = (res.data && res.data.data) ? res.data.data : res.data
      descriptionList.value.push({
        id: created.id,
        description: created.description,
        order: created.order,
        id_locale: created.id_locale,
        id_tips: created.id_tips
      })
      Swal.fire({ icon: 'success', title: 'Agregado', text: 'Descripción creada', timer: 1200, showConfirmButton: false })
    } else {
        
      // EDITAR
      const target = descriptionList.value[editingIndex.value]
      await httpRequest({
        url: '/description-tips/' + target.id,
        method: 'PUT',
        data: {
          description: form.value.description,
          id_locale: form.value.id_locale
        }
      })
      target.description = form.value.description
      target.id_locale = form.value.id_locale
      Swal.fire({ icon: 'success', title: 'Actualizado', text: 'Descripción actualizada', timer: 1200, showConfirmButton: false })
    }
    closeDesc()
  } catch (e) {
    console.error('Error guardando descripción:', e)
    Swal.fire('Error', 'No se pudo guardar la descripción', 'error')
  }
}

/* ===== Eliminar descripción ===== */
const deleteDescription = async (id) => {
  const r = await Swal.fire({
    title: '¿Eliminar esta descripción?',
    text: 'Esta acción no se puede deshacer.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Eliminar',
    cancelButtonText: 'Cancelar'
  })
  if (!r.isConfirmed) return

  try {
    await httpRequest({ url: '/description-tips/' + id, method: 'DELETE' })
    descriptionList.value = descriptionList.value.filter(d => d.id !== id)
    normalizeOrders()
    await persistOrder()
    Swal.fire({ icon: 'success', title: 'Eliminado', text: 'Descripción eliminada', timer: 1200, showConfirmButton: false })
  } catch (e) {
    console.error('Error al eliminar descripción:', e)
    Swal.fire('Error', 'No se pudo eliminar la descripción', 'error')
  }
}

/* ===== Drag & drop ===== */
const onDragEnd = async () => {
  for (let i = 0; i < descriptionList.value.length; i++) descriptionList.value[i].order = i
  await persistOrder()
}

onMounted(getTips)
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
                <h3 class="card-title mb-0">Editar Tip</h3>
              </div>

             <div class="card-body">
                  <div class="inputs">
                    <InputComponent label="Título" v-model="data.name" placeholder="Ingrese el título" />
                    <InputComponent label="Imagen principal" v-model="data.image" placeholder="URL de la imagen" />
                    <InputComponent label="Imagen del autor" v-model="data.image_author" placeholder="URL de la imagen del autor" />
                    <InputComponent label="Nombre del autor" v-model="data.author" placeholder="Ingrese el autor" />
                    <InputComponent label="Área" v-model="data.area" placeholder="Ingrese el área" />
                    <InputComponent label="Introducción" v-model="data.introduction" placeholder="Escriba la introducción" />

                    <!-- DESCRIPCIONES -->
                    <div class="form-group mt-3">
                      <div class="d-flex justify-content-between align-items-center mb-2 sticky-header">
                        <label class="form-label m-0">Bloques de descripciones</label>
                        <div class="d-flex gap-2">
                          <button type="button" class="btn btn-success btn-sm" @click="openDesc(-1)">
                            Agregar descripción
                          </button>
                        </div>
                      </div>

                      <div class="desc-scroll">
                        <draggable
                          v-model="descriptionList"
                          item-key="id"
                          class="list-group"
                          @end="onDragEnd"
                          handle=".drag-handle"
                          :animation="180"
                          ghost-class="drag-ghost"
                        >
                          <template #item="{ element, index }">
                            <DescriptionItem
                              :element="element"
                              :index="index"
                              @edit="openDesc"
                              @delete="deleteDescription"
                            />
                          </template>
                        </draggable>
                      </div>
                    </div>

                    <hr />

                    <div class="actions mt-3">
                      <button type="button" class="btn btn-danger" @click="deleteTip">Eliminar</button>
                      <button type="button" class="btn btn-primary" @click="savetip">Guardar</button>
                    </div>
                  </div>
                </div>
            </div>
          </div>

          <!-- MODAL -->
          <ModalComponent :show="showDescModal" @close="closeDesc">
           <template #title>
            {{ editingIndex !== -1 ? 'Editar descripción' : 'Agregar descripción' }}
          </template>


            <template #body>
              <div class="mb-3">
                <label class="form-label">Contenido</label>
                <div class="modal-editor-scroll">
                  <QuillEditor
                    v-model:content="form.description"
                    content-type="html"
                    theme="snow"
                    class="editor-box"
                  />
                </div>
              </div>
            </template>

            <template #footer>
              <button class="btn btn-secondary me-2" type="button" @click="closeDesc">Cancelar</button>
              <button class="btn btn-primary" type="button" @click="saveDesc">Guardar</button>
            </template>
          </ModalComponent>
          <!-- /MODAL -->
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
