<template>
    <nav
        :key="url"
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
                    class="menu-toggle"
                    type="button"
                    @click="hideMobileSideMenu"
                >
                    <icon-close />
                </button>
            </div>

            <div class="logo">
                TVI
            </div>
        </div>

        <!-- TODO: Use current route for active item -->

        <!-- Main Nav -->
        <ul class="mt-2">
            <li>
                <inertia-link
                    class="menu-link"
                    :class="{'menu-link-active': $routeCurrent('admin.index')}"
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

        <template v-if="showSettingsMenu">
            <div class="menu-separator"></div>

            <!-- Settings -->
            <p class="menu-subheading">
                Settings
            </p>

            <ul class="mt-2">
                <li>
                    <inertia-link
                        v-if="userCan('users.view')"
                        class="menu-link"
                        :class="{'menu-link-active': $routeCurrent('admin.users.*')}"
                        :href="$route('admin.users.index')"
                    >
                        <icon-users class="w-5"/>

                        <span class="ml-2">Users</span>
                    </inertia-link>
                </li>
            </ul>
        </template>

    </nav>
</template>

<script>
    export default {
        name: "SideMenu",
        props: {
            url: String,
        },
        computed: {
            isMobileSideMenuOpen() {
                return this.$store.getters.isMobileSideMenuOpen;
            },
            showSettingsMenu() {
                return this.userCan('users.view');
            }
        },
        methods: {
            hideMobileSideMenu() {
                this.$store.commit('hideMobileSideMenu');
            },
        }
    }
</script>
