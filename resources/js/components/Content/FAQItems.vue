<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
    faq: {
        type: Array,
        required: true
    }
});

const emit = defineEmits(['addNewFAQ']);

const randomId = Math.random().toString(36).substring(2, 15);
const localItems = ref([...props.faq]);
// Observar cambios en los props
watch(() => props.faq, (newItems) => {
    localItems.value = [...newItems];
}, { deep: true });

const addNewFAQ = () => {
    emit('addNewFAQ');
}

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
                            <button type="button" class="btn btn-danger btn-sm" @click="deleteItem(index)">
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
            <button type="button" class="btn btn-success" @click="addNewFAQ">
                <i class="fas fa-plus me-2"></i>
                Agregar FAQ
            </button>
        </div>

    </div>
</template>