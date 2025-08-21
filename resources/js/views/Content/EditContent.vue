<script setup lang="ts">
import Navbar from "../../components/Navbar.vue";
import Sidebar from "../../components/Sidebar.vue";
import { useRoute, useRouter } from "vue-router";
import { httpRequest } from "../../utils/global-request";
import { onMounted, ref } from "vue";
import { QuillEditor } from "@vueup/vue-quill";
import Quill from "quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import CarruselItem from "../../components/Content/CarruselItem.vue";
import Breadcrumb from "@/components/Breadcrumb.vue";
import FAQItems from "../../components/Content/FAQItems.vue";
import prew from "@/components/preview/prev.vue";
import Swal from 'sweetalert2';

const contenidoHtml = ref('');
const route = useRoute();
const router = useRouter();
const id = route.params.id;
const content = ref([]);

const breadcrumbItems = ref([
    { label: "Secciones", href: "/sections" },
    { label: "Contenido", href: `/content/` },
    { label: "Editor de contenido", href: "/edit-content" },
]);

const SizeStyle = Quill.import("attributors/style/size");
SizeStyle.whitelist = [
    "12px",
    "14px",
    "16px",
    "18px",
    "24px",
    "32px",
    "48px",
    "53px",
];
Quill.register(SizeStyle, true);

const globalOptions = {
    debug: "",
    modules: {
        toolbar: "#custom-toolbar",
        // Otros módulos disponibles:
        history: {
            delay: 2000,
            maxStack: 500,
            userOnly: true,
        },
        clipboard: {
            matchVisual: false,
        },
        keyboard: {
            bindings: {},
        },

        syntax: true, // true para resaltar código (necesita highlight.js)
    },
    formats: [
        "size",
        "color",
        "bold",
        "italic",
        "underline",
        "strike",
        "blockquote",
        "code-block",
        "list",
        "bullet",
        "link",
        "image",
        "video",
    ],
    theme: "snow",
};
// set default globalOptions prop
QuillEditor.props.globalOptions.default = () => globalOptions;

const getContentById = async () => {
    try {
        const response = await httpRequest({
            url: `/content-by-id/${id}`,
            method: "GET",
        });
        content.value = response.data;
        breadcrumbItems.value[1].href = `/content/${response.data.id_section}`

        contenidoHtml.value = response.data.bloque_principal;

        // Asegurar que carruselItems existe
        if (!content.value.carruselItems) {
            content.value.carruselItems = [];
        }

    } catch (err) {
        console.error(err);
    }
};

const guardarContent = async () => {
    const data = {
        id: id,
        title: content.value.name,
        bloque_principal: contenidoHtml.value,
        bloque_secundario: content.value.bloque_secundario,
        url: content.value.url,
        carruselItems: content.value.carruselItems,
        image: content.value.image,
        id_locale: content.value.id_locale,
    }
    try {
        const response = await httpRequest({
            url: `/content/${id}`,
            method: 'PUT',
            data: data
        });
        if (response.success) {
          Swal.fire({
            title: 'Contenido actualizado',
            text: response.msg,
            icon: 'success',
            confirmButtonText: 'Aceptar'
          })
        } else {
          Swal.fire({
            title: 'Error',
            text: response.msg,
            icon: 'error',
            confirmButtonText: 'Aceptar'
          })
        }
    } catch (err) {
        console.error(err);
    }
}

const regresar = () => {
    router.go(-1);
}

const descartarCambios = async (id: int) => {
    try {
         const result = await Swal.fire({
            title: '¿Estás seguro de descartar este borrador?',
            text: `¿Deseas publicar el borrador?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'rgba(80, 210, 93, 1)',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, descartar',
            cancelButtonText: 'Cancelar'
        });

        if (result.isConfirmed) {
            const response = await httpRequest({
                url: `/content/unpublish/${id}`,
                method: "GET",
            });
            Swal.fire({
                title: 'Borrador Descartado',
                text: response.msg,
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
            regresar();
        }
    } catch (err) {
        console.error(err);
    }
};



onMounted(() => {
    getContentById();
});
</script>

<template>
    <div id="wrapper">
        <Sidebar />
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <Navbar />
                <div class="container-fluid">
                    <Breadcrumb :items="breadcrumbItems" />
                    <div class="container">
                        <div class="card m-3">
                            <div class="card-header">
                                <div class="card-title">
                                    <div class="status-dot"></div>
                                    Editor de Contenido
                                </div>
                            </div>

                            <div class="card-content">
                                <form id="hospitalForm">
                                    <!-- Información Básica -->
                                    <div class="section">
                                        <div class="section-header">
                                            <span class="badge badge-pill badge-primary">Básico</span>
                                            <h3 class="section-title">
                                                Información Principal
                                            </h3>
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Nombre del contenido</label>
                                            <input type="text" id="name" placeholder="Titulo" v-model="content.name" />
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Bloque Principal</label>
                                            <div id="custom-toolbar">
                                                <select class="ql-size">
                                                    <option value="12px">
                                                        12 px
                                                    </option>
                                                    <option value="14px">
                                                        14 px
                                                    </option>
                                                    <option value="16px">
                                                        16 px
                                                    </option>
                                                    <option value="18px">
                                                        18 px
                                                    </option>
                                                    <option value="24px">
                                                        24 px
                                                    </option>
                                                    <option value="32px">
                                                        32 px
                                                    </option>
                                                    <option value="48px">
                                                        48 px
                                                    </option>
                                                    <option value="53px">
                                                        53 px
                                                    </option>
                                                </select>
                                                <button class="ql-bold"></button>
                                                <button class="ql-italic"></button>
                                                <button class="ql-underline"></button>
                                                <select class="ql-color"></select>
                                                <button class="ql-list" value="ordered"></button>
                                                <button class="ql-list" value="bullet"></button>
                                                <button class="ql-link"></button>
                                                <button class="ql-clean"></button>
                                            </div>
                                            <quill-editor ref="editorRef" theme="snow" toolbar="#custom-toolbar"
                                                contentType="html" :global-options="globalOptions"
                                                v-model:content="contenidoHtml" />
                                            <div class="help-text">
                                                El HTML se generará
                                                automáticamente
                                            </div>
                                            <div style="margin-top:20px;">
                                                <label>Vista previa HTML:</label>
                                                <div v-html="contenidoHtml" style="border:1px solid #eee;padding:12px;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="url">Texto del Botón</label>
                                            <input type="text" id="url" placeholder="Texto del botón de acción"
                                                v-model="content.url" />
                                        </div>
                                        <div class="form-group">
                                            <label for="type_carrusel">Edición de contenido del carrusel</label>
                                            <CarruselItem :items="content.carruselItems || []"
                                                :type_carrusel="content.type_carrusel"
                                                :id_content="id"
                                                @update:items="content.carruselItems = $event" />

                                        </div>
                                        <div class="form-group">
                                            <label for="name">FAQ</label>

                                                <FAQItems :faq="content.faq || []" :id_content="id"  />

                                        </div>
                                    </div>

                                    <div class="separator"></div>

                                    <!-- Configuración Técnica -->
                                    <div class="section">
                                        <div class="section-header">
                                            <span class="badge secondary">Técnico</span>
                                            <h3 class="section-title">
                                                Configuración
                                            </h3>
                                        </div>

                                        <div class="form-group">
                                            <label for="image">URL de Imagen</label>
                                            <input type="url" id="image" placeholder="https://ejemplo.com/imagen.jpg"
                                                v-model="content.image" />
                                        </div>
                                        <div class="form-group">
                                            <label for="locale">Idioma</label>
                                            <select id="locale" class="form-select" v-model="content.id_locale">
                                                <option value="1">Español</option>
                                                <option value="2">Inglés</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="actions">
                                        <button type="button" class="btn btn-secondary" @click="regresar">
                                            ← Regresar
                                        </button>
                                        <button type="button" class="btn btn-success" @click="guardarContent">
                                            Guardar
                                        </button>
                                        <button type="button" class="btn btn-danger" v-if="content.content_id_parent !== null"
                                            @click="descartarCambios(content.id)">
                                            Descartar Cambios
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <hr>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <prew :content="content"></prew>
                                </div>
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
    max-width: 800px;
    margin: 0 auto;
}

.header {
    text-align: center;
    margin-bottom: 40px;
}

.header h1 {
    color: #1f2937;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 8px;
}

.header p {
    color: #6b7280;
    font-size: 1rem;
}

.card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.card-header {
    background: #f8fafc;
    border-bottom: 1px solid #e5e7eb;
    padding: 20px;
}

.card-title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 1.25rem;
    font-weight: 600;
    color: #1f2937;
}

.status-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #10b981;
}

.card-content {
    padding: 30px;
}

.section {
    margin-bottom: 32px;
}

.section:last-child {
    margin-bottom: 0;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
}

.badge {
    background: #f3f4f6;
    color: #374151;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
    border: 1px solid #d1d5db;
}

.badge.secondary {
    background: #e5e7eb;
    color: #4b5563;
}

.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1f2937;
}

.form-group {
    margin-bottom: 20px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.form-row.single {
    grid-template-columns: 1fr;
}

label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
    margin-bottom: 6px;
}

input,
textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    background: white;
}

input:focus,
textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

textarea {
    min-height: 100px;
    resize: vertical;
    font-family: inherit;
}

.help-text {
    font-size: 0.75rem;
    color: #6b7280;
    margin-top: 4px;
}

.separator {
    height: 1px;
    background: #e5e7eb;
    margin: 24px 0;
}

.actions {
    display: flex;
    gap: 12px;
    margin-top: 32px;
}

.btn {
    flex: 1;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-primary {
    background: #3b82f6;
    color: white;
}

.btn-primary:hover {
    background: #2563eb;
}

.btn-secondary {
    background: transparent;
    color: #374151;
    border: 1px solid #d1d5db;
}

.btn-secondary:hover {
    background: #f9fafb;
}

.toast {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #10b981;
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transform: translateX(100%);
    transition: transform 0.3s ease;
    z-index: 1000;
}

.toast.show {
    transform: translateX(0);
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }

    .actions {
        flex-direction: column;
    }

    .header h1 {
        font-size: 1.5rem;
    }
}
</style>
