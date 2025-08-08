<script setup>

import { ref } from 'vue'

const props = defineProps({
    data: {
        type: Array,
        son: String,
        required: true
    }
})

const emit = defineEmits(['refresh'])

const showModal = ref(false)
const logItem = ref(null)

const openModal = (log) => {
    logItem.value = { ...log }
    showModal.value = true
    document.body.classList.add('modal-open')
}

const closeModal = () => {
    showModal.value = false
    logItem.value = {}
    document.body.classList.remove('modal-open')
}

</script>
<template>
    <div v-if="showModal" class="modal fade show d-block" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalle Cambios</h5>
                    <button type="button" class="close" @click="closeModal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <pre>
                                <code>
                                {{ logItem.changes }}
                            </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Modelo</th>
                <th scope="col">Acción</th>
                <th scope="col">Id Modelo</th>
                <th scope="col">Cambios</th>
                <th scope="col">Usuario</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="log in data" :key="log.id">
                <td>{{ log.id }}</td>
                <td>{{ log.model }}</td>
                <td>{{ log.action }}</td>
                <td>{{ log.model_id }}</td>
                <td @click="openModal(log)">
                    <button class="btn btn-primary">Ver Cambios</button>
                </td>
                <td>
                    {{ log.user_id }} - {{ log.user.name }}
                </td>
            </tr>
        </tbody>
    </table>
</template>
