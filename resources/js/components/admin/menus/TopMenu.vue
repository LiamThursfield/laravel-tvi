<template>
    <nav class="bg-white flex flex-row h-14 items-center px-4 relative shadow-sm">
        <button
            class="
                        text-indigo-900
                        lg:hidden
                        focus:outline-none focus:text-indigo-700
                        hover:text-indigo-700
                    "
            type="button"
            @click="showMobileSideMenu"
        >
            <icon-hamburger-menu />
        </button>

        <p class="ml-auto text-indigo-900">
            {{ $page.auth.user.first_name }}
        </p>

        <span class="text-indigo-300 px-2">|</span>

        <inertia-link
            class="
                text-indigo-600
                hover:text-indigo-400
            "
            :href="$route('logout')"
            method="post"
        >
            Logout
        </inertia-link>
    </nav>
</template>

<script>
    export default {
        name: "TopMenu",
        methods: {
            showMobileSideMenu() {
                this.$store.commit('showMobileSideMenu');
            }
        }
    }
</script>
