<template>
    <nav
        class="top-menu"
    >
        <button
            class="
                menu-link
                lg:hidden
                focus:outline-none
            "
            type="button"
            @click="showMobileSideMenu"
        >
            <icon-hamburger-menu />
        </button>

        <p class="ml-auto">
            {{ $page.auth.user.first_name }}
        </p>

        <span class="text-gray-300 px-2">|</span>

        <inertia-link
            class="menu-link"
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
