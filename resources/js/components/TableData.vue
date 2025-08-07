<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

const emit = defineEmits(['delete'])

const props = defineProps({
    data: {
        type: Array,
        son: String,
        required: true
    },
    hasDelete: {
        type: Boolean,
        default: false
    }
})

const redirect = (id) => {
    router.push(`/${props.data.son}/${id}`)
}

const requestDelete = (id) => {
    emit('delete', id)
}
</script>
<template>
      <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(section, index) in data" :key="section.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ section.name }}</td>
                                <td>
                                    <button class="btn btn-primary me-2" @click="redirect(section.id)">Editar</button>
                                    <button v-if="hasDelete" class="btn btn-danger" @click="requestDelete(section.id)">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
       </table>
</template>