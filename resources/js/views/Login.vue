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
            v-model="email"
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
            v-model="password"
            class="form-control"
            placeholder="********"
            required
          />
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Ingresar</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Login',
  data() {
    return {
      email: '',
      password: '',
    };
  },
  methods: {
    login() {
      if (!this.email || !this.password) {
        alert('Por favor completa todos los campos');
        return;
      }

      console.log('Login con:', this.email, this.password);


      this.$router.push('/home'); // Simula login exitoso
    },
  },
};
</script>
