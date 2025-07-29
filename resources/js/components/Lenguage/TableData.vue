<script setup>
const props = defineProps({
    data: {
        type: Array,
        required: true
    }
})
</script>
<template>
      <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col"></th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="section in data" :key="section.id">
                                <td>{{ section.id }}</td>
                                <td>{{ section.name }}</td>
                                <td>{{ section.slug }}</td>
                                <td>
                                    <button class="btn btn-primary">Editar</button>
                                </td>
                            </tr>
                        </tbody>
       </table>
</template>