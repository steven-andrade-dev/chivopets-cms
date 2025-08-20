<script setup>
import { ref, watch, onMounted } from 'vue';
import ModalComponent from '../ModalComponent.vue';
import SelectComponent from '../SelectComponent.vue';
import { httpRequest } from '../../utils/global-request';
import Swal from 'sweetalert2';
const props = defineProps({
    faq: {
        type: Array,
        required: true
    },
    id_content: {
        type: String,
        required: false
    }
});

const emit = defineEmits(['addNewFAQ']);
const randomId = Math.random().toString(36).substring(2, 15);
const localItems = ref([...props.faq]);
const listFAQ = ref([]);
const showModal = ref(false);
const selectedFAQ = ref(null);


// Observar cambios en los props
watch(() => props.faq, (newItems) => {
    localItems.value = [...newItems];
}, { deep: true });

const saveFAQ = async () => {
    const response = await httpRequest({
        url: `/content_faq`,
        method: "POST",
        data: {
            id_content: props.id_content,
            id_faq: selectedFAQ.value
        }
    })
    if(response.success){
        Swal.fire({
            title: '¡Guardado!',
            text: 'La pregunta ha sido guardada correctamente',
            icon: 'success',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Aceptar',
            timer: 2000,
            timerProgressBar: true
        });
        const data = listFAQ.value.find(item => item.id == selectedFAQ.value);
        const pushData = {
            id_relacion: response.data.id,
            question: data.name,
            answer: data.answer,
            id_locale: data.id_locale
        }
        localItems.value.push(pushData);
        showModal.value = false;

    }
}

const getListFAQ = async () => {
    try {
        const response = await httpRequest({
        url: `/faq`,
        method: "GET",
    })
    listFAQ.value = response.data;
    } catch (error) {
        console.log(error);
    }
}

const deleteItem = async (id) => {


    // Confirmación única
    const result = await Swal.fire({
        title: '¿Estás seguro?',
        text: `¿Deseas eliminar la pregunta?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    });

    if (result.isConfirmed) {
        try {
            const response = await httpRequest({
                 url: `/content_faq/${id}`,
                 method: 'DELETE',
            });
            if(response.success){
            // Eliminar del array local
            const index = localItems.value.findIndex(faq => faq.id_relacion === id);
            if (index !== -1) {
                localItems.value.splice(index, 1);
            }

            // Mensaje de éxito
            Swal.fire({
                title: '¡Eliminado!',
                text: 'La pregunta ha sido eliminada correctamente',
                icon: 'success',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Aceptar',
                timer: 2000,
                timerProgressBar: true
            });
        }else{
            Swal.fire({
                title: 'Error',
                text: 'No se pudo eliminar la pregunta',
                icon: 'error',
                confirmButtonColor: '#dc3545'
            });
        }
        } catch (error) {
            Swal.fire({
                title: 'Error',
                text: 'No se pudo eliminar la pregunta',
                icon: 'error',
                confirmButtonColor: '#dc3545'
            });
        }
    }
}

const closeModal = () => {
    showModal.value = false;
    selectedFAQ.value = null;
}

// Ejecutar cuando se monta el componente
onMounted(() => {
    getListFAQ();
});

</script>
<template>
    <div>
        <div v-if="localItems.length == 0">
            <p>Esta seccion no cuenta con un carrusel</p>
        </div>

        <div class="accordion" id="faqAccordion">
            <div v-for="(faq, index) in localItems" :key="faq.id || randomId" class="accordion-item">
                <h2 class="accordion-header" :id="`heading-${randomId}`">
                    <button
                        class="accordion-button"
                        :class="{ collapsed: true }"
                        type="button"
                        data-bs-toggle="collapse"
                        :data-bs-target="`#collapse-${index+randomId}`"
                        :aria-expanded="false"
                        :aria-controls="`collapse-${randomId}`">
                        <div class="d-flex justify-content-between align-items-center w-100 me-3">
                            <span class="card-number">Entrada {{ index + 1 }}</span>
                            <span class="item-title">{{ faq.question || 'Sin título' }}</span>
                        </div>
                    </button>
                </h2>
                <div
                    :id="`collapse-${index+randomId}`"
                    class="accordion-collapse collapse"
                    :class="{ show: false }"
                    :aria-labelledby="`heading-${randomId}`"
                    data-bs-parent="#faqAccordion">

                    <div class="accordion-body">
                        <!-- Botón de eliminar -->
                        <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn btn-danger btn-sm" @click="deleteItem(faq.id_relacion)">
                                <i class="fas fa-trash me-1"></i>
                                Eliminar
                            </button>
                        </div>

                        <!-- Información básica -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label  class="form-label">Pregunta</label>
                                    <div class="faq-answer" v-html="faq.question"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label  class="form-label">Respuesta</label>
                                    <div class="faq-answer" v-html="faq.answer"></div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="button" class="btn btn-success" @click="showModal = true">
                <i class="fas fa-plus me-2"></i>
                Agregar FAQ
            </button>
        </div>

    </div>

<ModalComponent :show="showModal" @close="showModal = false">
    <template #title>
      Agregar FAQ
    </template>
    <template #body>

            <SelectComponent
                label="FAQ"
                icon="bi bi-translate"
                v-model="selectedFAQ"
                :options="listFAQ"
                placeholder="Selecciona una pregunta"
                required
            />

    </template>
    <template #footer>
        <div class="">
            <button class="btn  me-2" @click="closeModal">Cancelar</button>
            <button class="btn btn-primary btn-glow" @click="saveFAQ">Guardar</button>
        </div>
    </template>
  </ModalComponent>
</template>
