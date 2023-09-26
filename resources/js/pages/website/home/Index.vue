<template>
    <div class="bg-gray-100 flex flex-col min-h-screen min-w-screen">
        <nav class="flex flex-row justify-end px-6 py-4">
            <ul class="flex flex-row font-medium space-x-4 text-theme-base-contrast">
                <template v-if="$page.props.auth.user">
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
        <section class="flex flex-1 flex-col items-center justify-center p-8">
            <div class="relative" >
                <div
                    class="
                        skewed-logo-bg
                        absolute bg-gradient-to-r from-blue-700 inset-0 to-blue-600 rounded-lg shadow-lg transform
                    "
                />
                <h1
                    class="
                        bg-theme-base-contrast flex flex-row font-semibold items-center px-8 py-4 relative rounded-lg text-center text-3xl tracking-wide
                        sm:text-6xl
                    "
                >
                    <icon-logo-dark class="w-9 sm:w-16" />
                    <span
                        class="
                            ml-3 text-white
                            sm:ml-6
                        "
                    >
                        SIGI - {{ $page.props.tenant.id }}
                    </span>
                </h1>
            </div>
            <ul class="flex flex-row flex-wrap font-medium justify-center mt-8 pt-4 px-4 space-x-6 text-theme-base-contrast md:text-lg">
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
        layout: 'home-layout'
    }
</script>

<style scoped>
    .skewed-logo-bg {
        --tw-rotate: -18deg;
        --tw-skew-y: 12deg
    }
</style>
