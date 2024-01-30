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
                {{ $page.props.auth.user.first_name }}
            </button>
        </div>

        <div
            ref="userDropdownMenu"
            class="
                flex flex-col py-2
                focus:outline-none
            "
        >

            <p class="dropdown-subheading mb-2">
                Hello, {{ $page.props.auth.user.first_name }}
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
                @click="closeUserDropdown"
            >
                Profile
            </inertia-link>

            <div class="dropdown-separator"></div>

            <inertia-link
                class="dropdown-link"
                as="button"
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
        data() {
            return {
                userDropDown: null,
            }
        },
        mounted() {
            this.initialiseUserDropdown();
        },
        methods: {
            closeUserDropdown() {
                try {
                    if (Array.isArray(this.userDropDown)) {
                        this.userDropDown.forEach(item => {
                            item.hide();
                        })
                    } else {
                        this.userDropDown.hide();
                    }
                } catch (e) {
                    console.log(e)
                }
            },
            initialiseUserDropdown() {
                let userDropdownMenu = this.$refs.userDropdownMenu;
                userDropdownMenu.style.display = 'block';

                this.userDropDown = tippy('#userDropdownButton',{
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
