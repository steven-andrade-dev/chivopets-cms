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
            default: 'faq'
        },
        hasDelete: {
            type: Boolean,
            default: false
        },
        hasEdit: {
            type: Boolean,
            default: true
        },
        hasStatus: {
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

    const redirect = (section) => {
        const targetId = section.parent?.id || section.id
        router.push(`/${props.data.son}/${targetId}`)
    }

    const requestDelete = (id) => {
        emit('delete', id)
    }

    const publishSection = async (status,id) => {
        var estado = status == 'Publicado' ? 'publicar' : 'archivar'
        try {
            const result = await Swal.fire({
                title: `¿Estás seguro de ${estado} este registro?`,
                text: `¿Deseas ${estado} el registro?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgba(80, 210, 93, 1)',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar'
            });

            if (result.isConfirmed) {
                    const response = await httpRequest({
                        url: `/${props.url}/change/${status}/status/${id}`,
                        method: 'PUT'
                    })
                    Swal.fire({
                        title: `${status}!`,
                        text: response.msg,
                        icon: 'success',
                        confirmButtonColor: '#28a745',
                        confirmButtonText: 'Aceptar',
                        timer: 2000,
                        timerProgressBar: true
                    });
                    emit('refresh')
            } else {
                Swal.fire({
                    title: `Elemento no ${status}`,
                    text: `El registro no fue ${status}`,
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
                    <th scope="col">Pregunta</th>
                    <th scope="col" v-if="hasStatus">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(section, index) in data" :key="section.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ section.question }}</td>
                    <td v-if="hasStatus">
                        {{ section.status }} {{ section.parent?.name ? '/ Borrador' : '' }}
                    </td>
                    <td>
                        <button class="btn btn-success me-2"
                            v-if="section.parent?.name || section.status == 'Creado' || section.status == 'Archivado'"
                            @click="publishSection('Publicado',section.id)">
                            Publicar  {{ section.parent?.name ? ' Borrador' : '' }}
                        </button>

                        <button class="btn btn-dark me-2"
                            v-if="!section.parent?.name && section.status == 'Publicado'"
                            @click="publishSection('Archivado',section.id)">
                            Archivar  {{ section.parent?.name ? ' Borrador' : '' }}
                        </button>
                        <button class="btn btn-primary me-2" @click="redirect(section)">
                            {{ props.DetailButton }}
                              {{ section.parent?.name ? ' Borrador' : '' }}
                        </button>
                        <button v-if="hasDelete" class="btn btn-danger" @click="requestDelete(section.id)">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
</template>
