<script setup>
import Sidebar from '../../components/Sidebar.vue';
import Navbar from '../../components/Navbar.vue';
import { ref, onMounted } from 'vue';
import { httpRequest } from '../../utils/global-request';
import { useRoute } from 'vue-router';
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import { useRouter } from 'vue-router';
import Swal from 'sweetalert2';
const router = useRouter();
const route = useRoute();
const id = route.params.id;


const question = ref({
    name: '',
    answer: ''
});

    const getQuestion = async () => {
        
        const response = await httpRequest({
            url: `/faq/${id}`,
            method: 'GET',
        })
        console.log(response.data)
        question.value = response.data[0];
}
const cancelEdit = () => {
    router.push('/questions');
}

const updateQuestion = async () => {
    console.log(question.value)
    const data = {
        question: question.value.name,
        answer: question.value.answer,
    }
    const response = await httpRequest({
        url: `/faq/${id}`,
        method: 'PATCH',
        data: data,
    })
    if(response.success){
        Swal.fire({
            title: 'Pregunta actualizada',
            text: 'La pregunta ha sido actualizada correctamente',
            icon: 'success',
        })
    }else{
        Swal.fire({
            title: 'Error',
            text: 'La pregunta no ha sido actualizada correctamente',
            icon: 'error',
        })
    }
}

onMounted(() => {
    getQuestion();
})
</script>
<template>
    <div id="wrapper">
        <Sidebar />
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <Navbar />
                <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Editar Pregunta</h1>
            </div>
            <div class="card-content">
               
                    <div class="form-group">
                        <label for="question" class="label">Pregunta</label>
                        <textarea 
                            id="question" 
                            class="textarea textarea-question"
                            placeholder="Escribe tu pregunta aquí..."
                            v-model="question.name"
                        ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="answer" class="label">Respuesta</label>
                        <quill-editor ref="editorRef" 
                            theme="snow" 
                            contentType="html"
                            v-model:content="question.answer" />
                    </div>

                    <div class="button-group">
                        <button type="button" class="button button-primary" @click="updateQuestion">
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Guardar
                        </button>
                        <button type="button" class="button button-secondary" @click="cancelEdit">
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancelar
                        </button>
                    </div>
                
            </div>
        </div>
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
<style>


.container {
    max-width: 600px;
    margin: 0 auto;
}

.card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.card-header {
    padding: 24px 24px 0;
    border-bottom: 1px solid #e5e5e5;
    margin-bottom: 24px;
}

.card-title {
    font-size: 20px;
    font-weight: 600;
    color: #1a1a1a;
}

.card-content {
    padding: 0 24px 24px;
}

.form-group {
    margin-bottom: 24px;
}

.label {
    display: block;
    font-size: 14px;
    font-weight: 500;
    color: #374151;
    margin-bottom: 8px;
}

.textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 14px;
    font-family: inherit;
    resize: vertical;
    transition: border-color 0.2s;
}

.textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.textarea-question {
    min-height: 80px;
}

.textarea-answer {
    min-height: 120px;
}

.button-group {
    display: flex;
    gap: 12px;
    margin-top: 32px;
}

.button {
    flex: 1;
    padding: 12px 16px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.button-primary {
    background-color: #3b82f6;
    color: white;
}

.button-primary:hover {
    background-color: #2563eb;
}

.button-secondary {
    background-color: white;
    color: #374151;
    border: 1px solid #d1d5db;
}

.button-secondary:hover {
    background-color: #f9fafb;
}

.icon {
    width: 16px;
    height: 16px;
}

@media (max-width: 640px) {
    .container {
        padding: 0 10px;
    }
    
    .card-header,
    .card-content {
        padding-left: 16px;
        padding-right: 16px;
    }
    
    .button-group {
        flex-direction: column;
    }
}
</style>