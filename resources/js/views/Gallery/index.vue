<template>
    <div id="wrapper">
        <Sidebar />
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <Navbar />
                <div class="container-fluid">
                    <Breadcrumb :items="breadcrumbItems" />
                    <h2>Subir Foto</h2>
                    <input type="file" @change="handleFileChange" />
                    <button class="btn btn-primary m-2" @click="uploadPhoto" :disabled="!selectedFile">Subir</button>

                    <h2>Fotos Guardadas</h2>
                    <div v-if="photos.length === 0">No hay fotos</div>
                    <div class="photos">
                        <img
                            v-for="(photo, index) in photos"
                            :key="index"
                            :src="photo"
                            style="max-width: 200px; margin: 10px;"
                        />
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

<script setup>
import { ref, onMounted } from 'vue';
import Sidebar from '../../components/Sidebar.vue'
import Navbar from '../../components/Navbar.vue'
import { httpRequest } from '../../utils/global-request'
import Breadcrumb from "@/components/Breadcrumb.vue";

const breadcrumbItems = ref([
  { label: "Galeria", href: "/" }
]);

const selectedFile = ref(null);
const photos = ref([]);

function handleFileChange(event) {
  selectedFile.value = event.target.files[0];
}

async function uploadPhoto() {
  if (!selectedFile.value) return;

  const formData = new FormData();
  formData.append('photo', selectedFile.value);

  try {
    const response = await httpRequest({
      url: '/gallery/upload',
      method: 'POST',
      data: formData,
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    })
    selectedFile.value = null;
    await loadPhotos();
  } catch (err) {
    console.error(err)
  }
}

const loadPhotos = async () => {
  try {
    const response = await httpRequest({
      url: '/gallery',
      method: 'GET',
    })
    photos.value = response.data
  } catch (err) {
    console.error(err)
  }
}

onMounted(() => {
  loadPhotos();
});
</script>
