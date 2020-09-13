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

        <div class="ml-auto select-none">
            <button
                id="userDropdownButton"
                class="menu-link"
            >
                {{ $page.auth.user.first_name }}
            </button>
        </div>

        <div
            ref="userDropdownMenu"
            class="
                dropdown
                flex flex-col py-2
                focus:outline-none
            "
        >

            <p class="dropdown-subheading mb-2">
                Hello, {{ $page.auth.user.first_name }}
            </p>

            <inertia-link
                class="dropdown-link"
                :href="$route('website.index')"
            >
                Homepage
            </inertia-link>

            <inertia-link
                v-if="userCan('profile.view')"
                class="dropdown-link"
                :href="$route('admin.profile.index')"
            >
                Profile
            </inertia-link>

            <div class="dropdown-separator"></div>

            <inertia-link
                class="dropdown-link"
                :href="$route('logout')"
                method="post"
            >
                Logout
            </inertia-link>
        </div>
    </nav>
</template>

<script>
    import tippy from 'tippy.js';
    import 'tippy.js/animations/shift-away-extreme.css';

    export default {
        name: "TopMenu",
        mounted() {
            this.initialiseUserDropdown();
        },
        methods: {
            initialiseUserDropdown() {
                let userDropdownMenu = this.$refs.userDropdownMenu;
                userDropdownMenu.style.display = 'block';

                tippy('#userDropdownButton',{
                    animation: 'shift-away-extreme',
                    content: userDropdownMenu,
                    interactive: true,
                    theme: 'dropdown',
                    trigger: 'click',
                });
            },
            showMobileSideMenu() {
                this.$store.commit('showMobileSideMenu');
            }
        },
    }
</script>

<style>
    .tippy-box[data-theme~='dropdown'] {
        background-color: #FFF;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05), 0 -2px 6px -2px rgba(0, 0, 0, 0.05);
        border-radius: 10px;
        min-width: 250px;
    }

    .tippy-box[data-theme~='dropdown']:focus {
        outline: none;
    }
</style>
