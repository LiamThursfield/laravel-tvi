<template>
    <div class="bg-theme-base flex flex-col min-h-screen min-w-screen">

        <nav class="flex flex-row justify-end px-6 py-4">
            <ul class="flex flex-row space-x-4 text-theme-base-contrast">
                <template v-if="$page.auth.user">
                    <li>
                        <a
                            class="hover:text-theme-primary"
                            :href="$route('admin.index')"
                        >
                            Admin
                        </a>
                    </li>
                </template>
                <template v-else>
                    <li v-if="$routeCheck('login')">
                        <inertia-link
                            class="hover:text-theme-primary"
                            :href="$route('login')"
                        >
                            Login
                        </inertia-link>
                    </li>
                    <li v-if="$routeCheck('register')">
                        <inertia-link
                            class="hover:text-theme-primary"
                            :href="$route('register')"
                        >
                            Register
                        </inertia-link>
                    </li>
                </template>
            </ul>
        </nav>

        <!-- Content Section -->
        <section class="flex flex-1 flex-col items-center justify-center p-4">
            <h1
                class="
                    font-black text-center text-3xl
                    md:leading-snug md:text-6xl
                "
            >
                {{ $page.app.name || 'Laravel TVI' }}
            </h1>
            <ul class="border-theme-base-contrast border-t flex flex-row mt-4 pt-4 space-x-6 text-theme-base-contrast md:text-lg">
                <li>
                    <a
                        class="hover:text-theme-primary"
                        href="https://laravel.com/docs/"
                        rel="noopener noreferrer"
                        target="_blank"
                    >
                        Laravel
                    </a>
                </li>
                <li>
                    <a
                        class="hover:text-theme-primary"
                        href="https://tailwindcss.com/docs/"
                        rel="noopener noreferrer"
                        target="_blank"
                    >
                        Tailwind
                    </a>
                </li>
                <li>
                    <a
                        class="hover:text-theme-primary"
                        href="https://vuejs.org/v2/guide/"
                        rel="noopener noreferrer"
                        target="_blank"
                    >
                        Vue.js
                    </a>
                </li>
                <li>
                    <a
                        class="hover:text-theme-primary"
                        href="https://inertiajs.com/"
                        rel="noopener noreferrer"
                        target="_blank"
                    >
                        Inertia.js
                    </a>
                </li>
            </ul>
        </section>
    </div>
</template>

<script>
    export default {
        name: "Index",
        layout: 'website-layout'
    }
</script>
