<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
    items: {
        type: Array,
        required: true,
        default: () => []
    },
    type_carrusel: {
        type: Number,
        required: true,
        default: 1
    }
});

const emit = defineEmits(['update:items']);

// Crear una copia reactiva de los items
const localItems = ref([...props.items]);

// Observar cambios en los props
watch(() => props.items, (newItems) => {
    localItems.value = [...newItems];
}, { deep: true });


// Función para actualizar un item específico
const updateItem = (index, field, value) => {
    localItems.value[index] = {
        ...localItems.value[index],
        [field]: value
    };
    emit('update:items', localItems.value);
};

// Función para eliminar un item
const deleteItem = (index) => {
    localItems.value.splice(index, 1);
    emit('update:items', localItems.value);
};

// Función para agregar un nuevo item
const addNewItem = () => {
    const newItem = {
        href: '',
        title: '',
        subtitle: '',
        description: '',
        image: '',
        title_info_aditional: '',
        value: '',
        id_locale: "1",
    };
    localItems.value.push(newItem);
    emit('update:items', localItems.value);
};

// Función para actualizar vista previa de imagen
const updateImagePreview = (event, previewId) => {
    const input = event.target;
    const preview = document.getElementById(previewId);
    const file = input.files?.[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="img-fluid rounded">`;
        };
        reader.readAsDataURL(file);
    } else if (input.value) {
        preview.innerHTML = `<img src="${input.value}" alt="Preview" class="img-fluid rounded">`;
    } else {
        preview.innerHTML = `
            <div class="text-muted text-center py-3 bg-light rounded">
                <i class="fas fa-image fa-2x mb-2"></i>
                <p class="mb-0">Vista previa de imagen</p>
            </div>
        `;
    }
};
</script>

<template>
    <div>
        <div v-if="localItems.length == 0">
            <p>Esta seccion no cuenta con un carrusel</p>
        </div>

        <div class="accordion" id="carouselAccordion">
            <div v-for="(item, index) in localItems" :key="item.id || index" class="accordion-item">
                <h2 class="accordion-header" :id="`heading-${index}`">
                    <button
                        class="accordion-button"
                        :class="{ collapsed: true }"
                        type="button"
                        data-bs-toggle="collapse"
                        :data-bs-target="`#collapse-${index}`"
                        :aria-expanded="false"
                        :aria-controls="`collapse-${index}`">
                        <div class="d-flex justify-content-between align-items-center w-100 me-3">
                            <span class="card-number">Entrada {{ index + 1 }}</span>
                            <span class="item-title">{{ item.title || 'Sin título' }}</span>
                        </div>
                    </button>
                </h2>

                <div
                    :id="`collapse-${index}`"
                    class="accordion-collapse collapse"
                    :class="{ show: false }"
                    :aria-labelledby="`heading-${index}`"
                    data-bs-parent="#carouselAccordion">

                    <div class="accordion-body">
                        <!-- Botón de eliminar -->
                        <!-- <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn btn-danger btn-sm" @click="deleteItem(index)">
                                <i class="fas fa-trash me-1"></i>
                                Eliminar
                            </button>
                        </div> -->

                        <!-- Información básica -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label :for="`title-${index}`" class="form-label">Título</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        :id="`title-${index}`"
                                        :value="item.title"
                                        @input="updateItem(index, 'title', $event.target.value)"
                                        placeholder="Título de la entrada">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label :for="`subtitle-${index}`" class="form-label">Subtítulo</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        :id="`subtitle-${index}`"
                                        :value="item.subtitle"
                                        @input="updateItem(index, 'subtitle', $event.target.value)"
                                        placeholder="Subtítulo opcional">
                                </div>
                            </div>
                        </div>

                        <!-- Descripción e Introducción -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label :for="`description-${index}`" class="form-label">Descripción</label>
                                    <textarea
                                        class="form-control"
                                        :id="`description-${index}`"
                                        :value="item.description"
                                        @input="updateItem(index, 'description', $event.target.value)"
                                        placeholder="Descripción de la entrada"
                                        rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label :for="`introduction-${index}`" class="form-label">Introducción</label>
                                    <textarea
                                        class="form-control"
                                        :id="`introduction-${index}`"
                                        :value="item.introduction"
                                        @input="updateItem(index, 'introduction', $event.target.value)"
                                        placeholder="Introducción de la entrada"
                                        rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Imagen -->
                        <div class="mb-3">
                            <label :for="`image-${index}`" class="form-label">URL de Imagen</label>
                            <input
                                type="url"
                                class="form-control"
                                :id="`image-${index}`"
                                :value="item.image"
                                @input="updateItem(index, 'image', $event.target.value)"
                                @change="updateImagePreview($event, `preview-${index}`)"
                                placeholder="https://ejemplo.com/imagen.jpg">
                            <div class="image-preview mt-2" :id="`preview-${index}`">
                                <img v-if="item.image" :src="item.image" alt="Preview" class="img-fluid rounded">
                                <div v-else class="text-muted text-center py-3 bg-light rounded">
                                    <i class="fas fa-image fa-2x mb-2"></i>
                                    <p class="mb-0">Vista previa de imagen</p>
                                </div>
                            </div>
                        </div>

                        <!-- Información adicional y valor numérico -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label :for="`title_info_adicional-${index}`" class="form-label">Información adicional</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        :id="`title_info_adicional-${index}`"
                                        :value="item.title_info_aditional"
                                        @input="updateItem(index, 'title_info_aditional', $event.target.value)"
                                        placeholder="Título de la información adicional">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label :for="`value-${index}`" class="form-label">Valor numérico</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        :id="`value-${index}`"
                                        :value="item.value"
                                        @input="updateItem(index, 'value', $event.target.value)"
                                        placeholder="Valor numérico">
                                </div>
                            </div>
                        </div>

                        <!-- Idioma y URL -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label :for="`id_locale-${index}`" class="form-label">Idioma</label>
                                    <select
                                        class="form-select"
                                        :id="`id_locale-${index}`"
                                        :value="item.id_locale"
                                        @input="updateItem(index, 'id_locale', $event.target.value)">
                                        <option value="1">Español</option>
                                        <option value="2">Inglés</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label :for="`href-${index}`" class="form-label">URL</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        :id="`href-${index}`"
                                        :value="item.href"
                                        @input="updateItem(index, 'href', $event.target.value)"
                                        placeholder="URL">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="type_carrusel === 2" class="text-center mt-4">
            <button type="button" class="btn btn-success" @click="addNewItem">
                <i class="fas fa-plus me-2"></i>
                Agregar nuevo Item
            </button>
        </div>
    </div>
</template>
<style>
/* Estilos personalizados para el acordeón */
.accordion-button:not(.collapsed) {
    background-color: #e7f1ff;
    color: #0c63e4;
}

.accordion-button:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.card-number {
    background: #3498db;
    color: white;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
}

.item-title {
    font-weight: 500;
    color: #495057;
    max-width: 300px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Estilos para la vista previa de imagen */
.image-preview {
    border: 2px dashed #dee2e6;
    border-radius: 0.375rem;
    transition: border-color 0.15s ease-in-out;
}

.image-preview:hover {
    border-color: #adb5bd;
}

.image-preview img {
    max-height: 200px;
    object-fit: cover;
}

/* Estilos responsivos */
@media (max-width: 768px) {
    .item-title {
        max-width: 150px;
    }

    .accordion-button {
        padding: 0.75rem;
    }

    .accordion-body {
        padding: 1rem;
    }
}

/* Animaciones suaves */
.accordion-collapse {
    transition: all 0.35s ease;
}

/* Mejoras visuales para los formularios */
.form-control:focus,
.form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

/* Estilos para el botón de agregar */
.btn-success {
    transition: all 0.2s ease-in-out;
}

.btn-success:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Estilos para el botón de eliminar */
.btn-danger {
    transition: all 0.2s ease-in-out;
}

.btn-danger:hover {
    transform: scale(1.05);
}

/* Mejoras para el acordeón en dispositivos móviles */
@media (max-width: 576px) {
    .accordion-button {
        font-size: 0.875rem;
    }

    .card-number {
        font-size: 10px;
        padding: 2px 8px;
    }

    .item-title {
        max-width: 120px;
        font-size: 0.875rem;
    }
}
</style>
