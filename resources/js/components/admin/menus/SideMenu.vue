<template>
    <nav
        class="side-menu"
        :class="{
            'side-menu-open': isMobileSideMenuOpen
        }"
    >
        <!-- Header -->
        <div class="relative">
            <div
                class="
                    absolute flex flex-row items-center inset-0 justify-start
                    lg:hidden
                "
            >
                <button
                    class="
                    text-white
                    focus:outline-none focus:text-indigo-200
                    hover:text-indigo-200
                "
                    type="button"
                    @click="hideMobileSideMenu"
                >
                    <icon-close />
                </button>
            </div>

            <div class="flex font-bold h-14 items-center justify-center text-white text-xl">
                Laravel TVI
            </div>
        </div>

        <!-- Main Nav -->
        <ul class="mt-2">
            <li>
                <inertia-link
                    class="menu-link menu-link-active"
                    :href="$route('admin.index')"
                >
                    <icon-home class="w-5"/>

                    <span class="ml-2">Home</span>
                </inertia-link>

                <inertia-link
                    class="menu-link"
                    :href="$route('admin.index')"
                >
                    <icon-home class="w-5"/>

                    <span class="ml-2">Link 1</span>
                </inertia-link>

                <inertia-link
                    class="menu-link"
                    :href="$route('admin.index')"
                >
                    <icon-home class="w-5"/>

                    <span class="ml-2">Link 1</span>
                </inertia-link>
            </li>
        </ul>

        <div class="menu-separator"></div>

        <!-- Settings -->
        <p class="menu-subheading">
            Settings
        </p>

        <ul class="mt-2">
            <li>
                <inertia-link
                    class="menu-link"
                    :href="$route('admin.index')"
                >
                    <icon-settings class="w-5"/>

                    <span class="ml-2">Link 1</span>
                </inertia-link>

                <inertia-link
                    class="menu-link"
                    :href="$route('admin.index')"
                >
                    <icon-settings class="w-5"/>

                    <span class="ml-2">Link 2</span>
                </inertia-link>

                <inertia-link
                    class="menu-link"
                    :href="$route('admin.index')"
                >
                    <icon-settings class="w-5"/>

                    <span class="ml-2">Link 3</span>
                </inertia-link>
            </li>
        </ul>

    </nav>
</template>

<script>
    export default {
        name: "SideMenu",
        computed: {
            isMobileSideMenuOpen() {
                return this.$store.getters.isMobileSideMenuOpen;
            }
        },
        methods: {
            hideMobileSideMenu() {
                this.$store.commit('hideMobileSideMenu');
            },
        }
    }
</script>
