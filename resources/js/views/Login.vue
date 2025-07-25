<template>
    <div class="container mt-5">
        <h2>🔐 Login</h2>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="login">
                    <fieldset>
                        <legend>Ingresa tus datos</legend>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="passwood" class="form-label">Password</label>
                            <input type="password" v-model="password" class="form-control" placeholder="Password" />
                        </div>
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </fieldset>
                </form>

            </div>

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
            // Aquí podrías hacer una llamada real a tu API Laravel
            console.log('Login con', this.email, this.password);

            // Simulación de login exitoso y redirección
            this.$router.push('/home');
        },
    },
};
</script>
