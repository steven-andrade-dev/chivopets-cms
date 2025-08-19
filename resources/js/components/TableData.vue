<script setup>
    import { ref } from 'vue'
    import { useRouter } from 'vue-router'
    import { httpRequest } from '@/utils/global-request'
    import ModalComponent from '@/components/ModalComponent.vue'
    import Swal from 'sweetalert2'

    const router = useRouter()

    const emit = defineEmits(['refresh','delete'])

    const props = defineProps({
        data: {
            type: Array,
            son: String,
            required: true
        },
        url: {
            type: String,
            default: 'sections'
        },
        hasDelete: {
            type: Boolean,
            default: false
        },
        hasEdit: {
            type: Boolean,
            default: true
        },
        EditButton: {
            type: String,
            default: 'Editar'
        },
        DetailButton: {
            type: String,
            default: 'Ver contenido'
        },
        PublicButton: {
            type: String,
            default: 'Publicar'
        }
    })

    const redirect = (id) => {
        router.push(`/${props.data.son}/${id}`)
    }

    const requestDelete = (id) => {
        emit('delete', id)
    }

    const selectedItem = ref({ parent: {} })
    const showModal = ref(false)

    const openModal = (section) => {
        selectedItem.value = {
            ...section,
            parent: section.parent ?? {}
        }


        showModal.value = true
        document.body.classList.add('modal-open')
    }

    const closeModal = () => {
        showModal.value = false
        selectedItem.value = null
        document.body.classList.remove('modal-open')
    }

    const updateItem = async () => {
        try {
            const response = await httpRequest({
                url: `/${props.url}/${selectedItem.value.id}`,
                method: 'PUT',
                data: selectedItem.value
            })
            Swal.fire({
                title: '¡Actualizado!',
                text: 'La sección ha sido eliminada correctamente',
                icon: 'success',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Aceptar',
                timer: 2000,
                timerProgressBar: true
            });
            emit('refresh')
            closeModal()

            return response
        } catch (err) {
            console.error(err)
        }
    }

    const publishSection = async (id) => {
        try {
            const result = await Swal.fire({
                title: '¿Estás seguro de publicar este borrador?',
                text: `¿Deseas publicar el borrador?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgba(80, 210, 93, 1)',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, publicar',
                cancelButtonText: 'Cancelar'
            });

            if (result.isConfirmed) {
                    const response = await httpRequest({
                        url: `/${props.url}/publish/${id}`,
                        method: 'PUT'
                    })
                    Swal.fire({
                        title: '¡Actualizado!',
                        text: 'La sección ha sido eliminada correctamente',
                        icon: 'success',
                        confirmButtonColor: '#28a745',
                        confirmButtonText: 'Aceptar',
                        timer: 2000,
                        timerProgressBar: true
                    });
                    emit('refresh')
                    closeModal()

                    return response
            } else {
                Swal.fire({
                    title: 'Elemento no publicado',
                    text: 'La sección no se ha publicado',
                    icon: 'info',
                    confirmButtonColor: '#288ca7ff',
                    confirmButtonText: 'Aceptar',
                    timer: 2000,
                    timerProgressBar: true
                });
            }
        } catch (err) {
            console.error(err)
        }
    }
</script>
<template>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(section, index) in data" :key="section.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ section.name }}</td>
                    <td>
                        {{ section.status }} {{ section.parent && section.parent.name ? '/ Borrador' : '' }}

                    </td>
                    <td>
                        <button class="btn btn-warning me-2"
                            v-if="(section.parent && section.parent.name) || section.status == 'Creado'"
                            @click="publishSection(section.id)">
                            {{ props.PublicButton }}  {{ section.parent && section.parent.name ? ' Borrador' : '' }}
                        </button>
                        <button class="btn btn-primary me-2" v-if="props.hasEdit" @click="openModal(section)">{{ props.EditButton }}</button>
                        <button class="btn btn-primary me-2" @click="redirect(section.id)">{{ props.DetailButton }}</button>
                        <button v-if="hasDelete" class="btn btn-danger" @click="requestDelete(section.id)">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <ModalComponent :show="showModal" @close="showModal = false">
            <template #title>
                Editar Sección
            </template>
            <template #body>
                <form>
                    <InputComponent label="Nombre" v-model="selectedItem.name" placeholder="Ingrese el nombre" />
                    <div v-if="selectedItem.parent.name">
                        <hr>
                        <h3>Borrador</h3>
                        <hr>
                        <InputComponent label="Nombre" v-model="selectedItem.parent.name" disabled />
                    </div>
                </form>
            </template>
            <template #footer>
                <div class="">
                    <button class="btn  me-2" @click="closeModal">Cancelar</button>
                    <button class="btn btn-primary btn-glow" v-if="!selectedItem.parent.name" @click="updateItem">Guardar</button>
                </div>
            </template>
        </ModalComponent>
</template>
