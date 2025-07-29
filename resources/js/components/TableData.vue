<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

const props = defineProps({
    data: {
        type: Array,
        son: String,
        required: true
    }
})

const redirect = (id) => {
    router.push(`/${props.data.son}/${id}`)
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
                            <tr v-for="section in data" :key="section.id">
                                <td>{{ section.id }}</td>
                                <td>{{ section.name }}</td>
                                <td>
                                    <button class="btn btn-primary" @click="redirect(section.id)">Editar</button>
                                </td>
                            </tr>
                        </tbody>
       </table>
</template>