<template>
    <div class="d-flex">

        <!-- Sidebar -->
        <div class="bg-dark text-white vh-100 p-3" style="width: 240px;">
            <h4>Mi App</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <router-link to="/home" class="nav-link text-white">🏠 Inicio</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/login" class="nav-link text-white">🚪 Logout</router-link>
                </li>
            </ul>
        </div>

        <!-- Main content -->
        <div class="flex-grow-1">
            <!-- Navbar -->
            <nav class="navbar navbar-expand navbar-light bg-light px-4">
                <span class="navbar-text">Bienvenido</span>
            </nav>

            <!-- Content -->
            <main class="p-4">
                <slot /> <!-- Aquí se renderiza la vista -->
            </main>
        </div>
    </div>
</template>

<script>
export default {
    name: 'DashboardLayout',
};
</script>
