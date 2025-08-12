<script setup>
import Sidebar from '../../../components/Sidebar.vue'
import Navbar from '../../../components/Navbar.vue'
import { httpRequest } from '../../../utils/global-request'
import { ref, onMounted } from 'vue'
import Breadcrumb from "@/components/Breadcrumb.vue"
import { QuillEditor } from "@vueup/vue-quill";
import Quill from "quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

const breadcrumbItems = ref([

  { label: "Casos", href: "/cases" },
  { label: "Crear Caso", href: "/create-case" }
]);

const SizeStyle = Quill.import("attributors/style/size");
SizeStyle.whitelist = [
    "12px","14px","16px","18px","24px","32px","48px","53px",
];

Quill.register(SizeStyle, true);

const globalOptions = {
    debug: "",
    modules: {
        toolbar: "#custom-toolbar",
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
        syntax: true,
        },
    formats: [
        "size","color","bold","italic","underline","strike","blockquote","code-block","list","bullet","link","image",
        "video",
    ],
    theme: "snow",
};
// set default globalOptions prop
QuillEditor.props.globalOptions.default = () => globalOptions;
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
                <h3 class="card-title mb-0">Crear Caso</h3>
              </div>
              <div class="card-body">
                <form>
                  <div class="form-group">
                    <label class="form-label fw-bold">Título</label>
                    <input type="text" class="form-control" placeholder="Ingrese el título" />
                  </div>
                  <div class="form-group">
                    <label class="form-label">Imagen principal</label>
                    <input type="file" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label class="form-label">Imagen del autor</label>
                    <input type="file" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label class="form-label">Nombre del autor</label>
                    <input type="text" class="form-control" placeholder="Ingrese el autor" />
                  </div>
                  <div class="form-group">
                    <label class="form-label">Área</label>
                    <input type="text" class="form-control" placeholder="Ingrese el área" />
                  </div>
                  <div class="form-group">
                    <label class="form-label">Introducción</label>
                    <textarea class="form-control" rows="3" placeholder="Escriba la introducción"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="description" class="form-label">Bloque Principal</label>
                    <div id="custom-toolbar">
                      <select class="ql-size">
                        <option value="12px">12 px</option>
                        <option value="14px">14 px</option>
                        <option value="16px">16 px</option>
                        <option value="18px">18 px</option>
                        <option value="24px">24 px</option>
                        <option value="32px">32 px</option>
                        <option value="48px">48 px</option>
                        <option value="53px">53 px</option>
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
                    <quill-editor
                      ref="editorRef"
                      theme="snow"
                      toolbar="#custom-toolbar"
                      contentType="html"
                      :global-options="globalOptions"
                      v-model:content="contenidoHtml"
                    />
                  </div>
                  <div class="actions mt-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
                </form>
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

<style scoped>
.card {
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}
.card-header {
  background: #f8f9fa;
  border-bottom: 1px solid #e5e7eb;
  padding: 1rem;
}
.form-group {
  margin-bottom: 1rem;
}
input, textarea {
  background-color: white !important;
}
.actions {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}
</style>


