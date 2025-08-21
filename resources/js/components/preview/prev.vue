

<script setup lang="ts">
    const props = defineProps({
        content: {
            type: Object,
            required: true
        }
    })
</script>

<template>
  <section class="position-relative text-white overflow-hidden home">
    <div class="container py-5">
      <div class="row align-items-center m-4">
        <!-- Texto -->
        <div class="col-md-6">
            <span v-html="content.bloque_principal"></span>
            <button class="position-relative btn btn-primary mb-8 p-3" style="background: #006AFF;">{{ content.url }}
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M680-80v-120H560v-80h120v-120h80v120h120v80H760v120h-80Zm-480-80q-33 0-56.5-23.5T120-240v-480q0-33 23.5-56.5T200-800h40v-80h80v80h240v-80h80v80h40q33 0 56.5 23.5T760-720v244q-20-3-40-3t-40 3v-84H200v320h280q0 20 3 40t11 40H200Zm0-480h480v-80H200v80Zm0 0v-80 80Z"/></svg>
            </button>
        </div>

        <!-- Imagen -->
        <div class="col-md-6 position-relative text-center">
          <div
            class="position-absolute top-0 start-50 translate-middle rounded-circle bg-info"
            style="width: 300px; height: 300px; opacity: 0.8; z-index:0;"
          ></div>
          <img
            src="https://via.placeholder.com/400x300"
            alt="Veterinario atendiendo mascota"
            class="img-fluid position-relative rounded shadow"
            style="z-index:1;"
          />
        </div>
      </div>
    </div>

    <div class="position-relative custom-shape-divider-bottom-1755806890">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
        </svg>
    </div>
  </section>
</template>

<style>
.home {
    background-color: #1F2146;
}
.custom-shape-divider-bottom-1755806890 {
    position: relative;
    bottom: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
}

.custom-shape-divider-bottom-1755806890 .shape-fill {
    fill: #FFFFFF;
}
</style>
