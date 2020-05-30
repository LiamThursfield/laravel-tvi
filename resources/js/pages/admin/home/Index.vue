<template>
    <div>
        <p>Admin</p>
        <p>{{ $page.auth.user.name }}</p>
        <inertia-link class="block px-6 py-2 hover:bg-indigo-500 hover:text-white" :href="$route('logout')" method="post">Logout</inertia-link>
    </div>
</template>

<script>

    export default {
        name: "AdminHomeIndex",
        layout: 'admin-layout',
    }
</script>
