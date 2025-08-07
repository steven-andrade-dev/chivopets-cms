<script setup>
    import { ref, onMounted } from 'vue'
    import { httpRequest } from '../utils/global-request'
    import { useRouter } from 'vue-router'
    import Swal from 'sweetalert2'

    const router = useRouter()
    const user = ref([])
    const isLoading = ref(false)

    const login = async () => {
        isLoading.value = true;
        if (!user.value.email || !user.value.password) {
            alert('Por favor completa todos los campos');
            return;
        }
        const data = {
            email: user.value.email,
            password: user.value.password,
        }
        try {
            const response = await httpRequest({
                data: data,
                url: `/login`,
                method: 'POST',
            })

            localStorage.setItem("auth_token", response.data.access_token)
            isLoading.value = false
            router.push('/sections')
        } catch (err) {
            isLoading.value = false
            if (err.status == 401) {
                Swal.fire({
                    title: 'Error',
                    text: err.response.data.msg,
                    icon: 'error',
                })

            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Error al procesar la solicitud, Intenta nuevamente',
                    icon: 'error',
                })
            }
            console.error(err)
        }
    }
</script>

<template>
  <div class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
      <div class="text-center mb-4">
        <h3 class="fw-bold">🔐 Iniciar Sesión</h3>
        <p class="text-muted">Ingresa tus credenciales para continuar</p>
      </div>
      <form @submit.prevent="login">
        <div class="mb-3">
          <label for="email" class="form-label">Correo electrónico</label>
          <input
            type="email"
            id="email"
            v-model="user.email"
            class="form-control"
            placeholder="usuario@ejemplo.com"
            required
          />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input
            type="password"
            id="password"
            v-model="user.password"
            class="form-control"
            placeholder="********"
            required
          />
        </div>
        <div class="d-grid">
            <button class="btn btn-primary" type="submit" :disabled="isLoading">
                <div v-if="!isLoading">
                    Ingresar
                </div>
                <div v-else>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Ingresando...
                </div>
            </button>
        </div>
      </form>
    </div>
  </div>
</template>
