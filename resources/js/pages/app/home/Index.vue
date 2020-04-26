<template>
    <div class="bg-gray-200 flex flex-col min-h-screen min-w-screen">

        <nav class="flex flex-row justify-end px-6 py-4">
            <ul class="flex flex-row space-x-4 text-gray-600">
                <template v-if="$page.auth.user">
                    <li>
                        <a
                            class="hover:text-blue-700"
                            :href="$route('admin.index')"
                        >
                            Admin
                        </a>
                    </li>
                </template>
                <template v-else>
                    <li>
                        <a
                            class="hover:text-blue-700"
                            :href="$route('login')"
                        >
                            Login
                        </a>
                    </li>
                    <li>
                        <a
                            class="hover:text-blue-700"
                            :href="$route('register')"
                        >
                            Register
                        </a>
                    </li>
                </template>
            </ul>
        </nav>

        <!-- Content Section -->
        <section class="flex flex-1 flex-col items-center justify-center">
            <h1 class="font-black text-6xl">
                {{ $page.app.name || 'Laravel TVI' }}
            </h1>
            <ul class="border-gray-400 border-t flex flex-row pt-4 space-x-6 text-gray-600 text-lg">
                <li>
                    <a
                        class="hover:text-blue-700"
                        href="https://laravel.com/docs/"
                        rel="noopener noreferrer"
                        target="_blank"
                    >
                        Laravel
                    </a>
                </li>
                <li>
                    <a
                        class="hover:text-blue-700"
                        href="https://tailwindcss.com/docs/"
                        rel="noopener noreferrer"
                        target="_blank"
                    >
                        Tailwind
                    </a>
                </li>
                <li>
                    <a
                        class="hover:text-blue-700"
                        href="https://vuejs.org/v2/guide/"
                        rel="noopener noreferrer"
                        target="_blank"
                    >
                        Vue.js
                    </a>
                </li>
                <li>
                    <a
                        class="hover:text-blue-700"
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
        layout: 'app-layout'
    }
</script>